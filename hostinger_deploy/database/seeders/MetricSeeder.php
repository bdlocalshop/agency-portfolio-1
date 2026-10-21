<?php

namespace Database\Seeders;

use App\Models\Metric;
use Illuminate\Database\Seeder;

class MetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metrics = [
            [
                'value' => '100%',
                'label' => 'On-Time Handover',
                'description' => 'Fixed-timeline milestones strictly honored',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'value' => '15+',
                'label' => 'Successful Deliveries',
                'description' => 'Production SaaS, Mobile & Extension platforms',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'value' => 'Zero',
                'label' => 'Tech Debt Guarantee',
                'description' => 'Strict PSR standards, typed schemas & tests',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'value' => '24/7',
                'label' => 'SLA Support',
                'description' => 'Dedicated uptime & incident response',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($metrics as $metric) {
            Metric::updateOrCreate(
                ['label' => $metric['label']],
                $metric
            );
        }
    }
}
