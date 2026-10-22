<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Initial admin user (per Phase 4 specifications: admin@agency.com / password)
        User::updateOrCreate(
            ['email' => 'admin@agency.com'],
            [
                'name' => 'Agency Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Alias admin
        User::updateOrCreate(
            ['email' => 'admin@vacklink.com'],
            [
                'name' => 'Agency Senior Partner',
                'password' => Hash::make('password123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Core taxonomies, projects, proof metrics, testimonials, site settings & inquiries
        $this->call([
            CategorySeeder::class,
            ProjectSeeder::class,
            MetricSeeder::class,
            TestimonialSeeder::class,
            SiteSettingSeeder::class,
            InquirySeeder::class,
        ]);
    }
}
