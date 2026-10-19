<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'Alexander Wright',
                'email' => 'alex.wright@fintechscale.io',
                'service_type' => 'Web Applications',
                'budget_range' => '$15,000 - $30,000',
                'message' => 'We are preparing to launch our series A FinTech analytics dashboard and need a dedicated team to build our Laravel/Tailwind web app and API integrations.',
                'ip_address' => '127.0.0.1',
                'status' => Inquiry::STATUS_NEW,
                'created_at' => now()->subHours(3),
            ],
            [
                'name' => 'Elena Rostova',
                'email' => 'elena@nordicdesign.co',
                'service_type' => 'Web Design & UI/UX',
                'budget_range' => '$5,000 - $10,000',
                'message' => 'Looking for complete Figma design system overhaul and component library for our architectural e-commerce store.',
                'ip_address' => '127.0.0.1',
                'status' => Inquiry::STATUS_CONTACTED,
                'created_at' => now()->subDays(1),
            ],
            [
                'name' => 'Marcus Chen',
                'email' => 'mchen@solardynamics.org',
                'service_type' => 'Mobile Applications',
                'budget_range' => '$20,000+',
                'message' => 'Need an iOS & Android field technician mobile app with offline synchronization for solar panel diagnostics.',
                'ip_address' => '127.0.0.1',
                'status' => Inquiry::STATUS_CLOSED,
                'created_at' => now()->subDays(4),
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::updateOrCreate(['email' => $inquiry['email']], $inquiry);
        }
    }
}
