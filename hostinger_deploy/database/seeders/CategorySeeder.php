<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Design & UI/UX',
                'slug' => 'web-design',
                'description' => 'User research, design systems, interactive prototypes, and conversion-optimized interfaces.',
                'icon' => 'palette',
                'sort_order' => 1,
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Fast, secure corporate portals, marketing websites, and headless content architecture.',
                'icon' => 'globe',
                'sort_order' => 2,
            ],
            [
                'name' => 'Web Applications',
                'slug' => 'web-apps',
                'description' => 'Complex SaaS platforms, internal business portals, and real-time collaborative workspaces.',
                'icon' => 'layout-grid',
                'sort_order' => 3,
            ],
            [
                'name' => 'Mobile Applications',
                'slug' => 'mobile-apps',
                'description' => 'Cross-platform iOS and Android apps with fluid 60fps animations and offline-first capabilities.',
                'icon' => 'smartphone',
                'sort_order' => 4,
            ],
            [
                'name' => 'Desktop Applications',
                'slug' => 'desktop-apps',
                'description' => 'Native utilities for macOS and Windows engineered for system speed, privacy, and productivity.',
                'icon' => 'monitor',
                'sort_order' => 5,
            ],
            [
                'name' => 'Browser Extensions',
                'slug' => 'browser-extensions',
                'description' => 'Manifest V3 Chrome and Firefox extensions enhancing productivity and contextual workflow automation.',
                'icon' => 'puzzle',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
