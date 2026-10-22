<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'agency_name' => 'VackLink',
                'tagline' => 'Software Engineering Studio',
                'hero_badge' => 'Software Engineering Studio',
                'hero_headline' => 'Engineering High-Performance Digital Products.',
                'hero_subheadline' => 'We design, engineer, and scale resilient web platforms, native mobile applications, and high-performance desktop utilities with deterministic delivery guarantees.',
                'primary_cta_text' => 'Get Architecture Proposal',
                'primary_cta_url' => '#contact',
                'secondary_cta_text' => 'Explore Case Studies',
                'secondary_cta_url' => '#portfolio',
                'contact_email' => 'hello@vacklink.com',
                'contact_phone' => '+1 (555) 019-2834',
                'contact_location' => 'San Francisco, CA & Remote Global',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'x_url' => 'https://x.com',
            ]
        );
    }
}
