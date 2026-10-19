<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Metric;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the agency landing page.
     */
    public function __invoke(): View
    {
        $siteSettings = SiteSetting::current();

        $categories = Category::active()
            ->ordered()
            ->withCount('projects')
            ->get();

        $projects = Project::with(['category', 'images'])
            ->ordered()
            ->get();

        $featuredProjects = $projects->where('is_featured', true)->values();

        // Prepare JSON payload for Alpine.js client-side state
        $projectsJson = $projects->map(function ($p) {
            return [
                'id' => $p->id,
                'title' => $p->title,
                'slug' => $p->slug,
                'client_name' => $p->client_name,
                'category_id' => $p->category_id,
                'category_name' => $p->category->name ?? 'Engineering',
                'category_slug' => $p->category->slug ?? 'all',
                'short_description' => $p->short_description,
                'full_description' => $p->full_description,
                'problem' => $p->problem ?: (explode("\n\nSolution:", $p->challenge_solution ?? '')[0] ?? ''),
                'solution' => $p->solution ?: (explode("\n\nSolution:", $p->challenge_solution ?? '')[1] ?? ''),
                'challenge_solution' => $p->challenge_solution,
                'tech_stack' => $p->tech_stack ?? [],
                'thumbnail_url' => $p->thumbnail_url,
                'external_url' => $p->external_url,
                'github_url' => $p->github_url,
                'is_featured' => (bool) $p->is_featured,
                'gallery' => $p->images->map(fn($img) => [
                    'url' => $img->image_url,
                    'caption' => $img->caption,
                ])->toArray(),
            ];
        });

        $metrics = Metric::active()->get();
        if ($metrics->isEmpty()) {
            $metrics = collect([
                (object) ['value' => '100%', 'label' => 'On-Time Handover', 'description' => 'Fixed-timeline milestones strictly honored'],
                (object) ['value' => '15+', 'label' => 'Successful Deliveries', 'description' => 'Production SaaS, Mobile & Extension platforms'],
                (object) ['value' => 'Zero', 'label' => 'Tech Debt Guarantee', 'description' => 'Strict PSR standards, typed schemas & tests'],
                (object) ['value' => '24/7', 'label' => 'SLA Support', 'description' => 'Dedicated uptime & incident response'],
            ]);
        }

        $testimonials = Testimonial::active()->get();
        if ($testimonials->isEmpty()) {
            $testimonials = collect([
                (object) [
                    'client_name' => 'Marcus Vance',
                    'role_company' => 'CTO at ApexLogistics',
                    'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                    'rating' => 5,
                    'quote' => 'Delivered our mobile cross-platform MVP 2 weeks ahead of schedule with zero production bugs on launch day.',
                ],
            ]);
        }

        return view('home', compact(
            'siteSettings',
            'categories',
            'projects',
            'featuredProjects',
            'projectsJson',
            'metrics',
            'testimonials'
        ));
    }
}
