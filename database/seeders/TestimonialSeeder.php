<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Marcus Vance',
                'role_company' => 'CTO at ApexLogistics',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'quote' => 'Delivered our mobile cross-platform MVP 2 weeks ahead of schedule with zero production bugs on launch day.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Elena Rostova',
                'role_company' => 'VP of Product at DataPulse',
                'avatar_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'quote' => 'Refactored our core Laravel analytics engine, slashing page load times by 68% and eliminating recurring queue deadlocks.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'Julian Keller',
                'role_company' => 'Founder at OmniFlow',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'quote' => 'Their desktop Electron & extension builds passed security reviews on the very first submission. Exceptional engineering rigor.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::updateOrCreate(
                ['client_name' => $item['client_name']],
                $item
            );
        }
    }
}
