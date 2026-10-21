<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');

        $projectsData = [
            [
                'category_slug' => 'web-development',
                'title' => 'AeroStep Global Footwear E-Commerce Platform',
                'slug' => 'aerostep-footwear-ecommerce',
                'client_name' => 'AeroStep Athletics Inc.',
                'short_description' => 'High-performance headless e-commerce store with sub-second page loads, modular category filtering, and 3D shoe inspection.',
                'full_description' => 'AeroStep required a digital flagship store to showcase their revolutionary urban running shoes and athletic apparel. We engineered an ultra-minimalist, high-converting digital storefront combining lightning-fast catalog navigation, sticky micro-cart interactions, and seamless multi-currency checkout.',
                'challenge_solution' => "Challenge: Legacy e-commerce platform suffered from 4.2s mobile load times and high cart drop-off during peak product drops.\n\nSolution: Architected an edge-cached headless storefront backed by Laravel and Tailwind CSS, slashing TTFB down to 180ms and boosting mobile conversion rate by 34%.",
                'tech_stack' => ['Laravel 11', 'Tailwind CSS', 'Alpine.js', 'MySQL', 'Stripe API', 'Cloudflare CDN'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://aerostep-demo.example.com',
                'is_featured' => true,
                'sort_order' => 1,
                'gallery' => [
                    'https://images.unsplash.com/photo-1552346154-21d32810aba3?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'web-apps',
                'title' => 'PulseMetrics AI Fleet Management Dashboard',
                'slug' => 'pulsemetrics-fleet-management',
                'client_name' => 'PulseMetrics Logistics Corp',
                'short_description' => 'Real-time telemetry, driver telemetry tracking, and predictive maintenance dispatch portal for enterprise vehicle fleets.',
                'full_description' => 'PulseMetrics needed a unified operations dashboard capable of ingesting over 100,000 GPS and engine diagnostic data points every minute across North American freight fleets. We developed a low-latency web application featuring interactive GIS mapping, automated fault-code alerting, and fuel efficiency scoring.',
                'challenge_solution' => "Challenge: Fleet dispatchers were juggling 5 disparate software tools, creating 15-minute response delays during vehicle breakdowns.\n\nSolution: Built a single-pane-of-glass dashboard consolidating GPS, maintenance alerts, and driver communications with instant WebSockets notifications.",
                'tech_stack' => ['Laravel', 'Vue.js', 'PostgreSQL', 'Redis', 'WebSockets', 'Tailwind CSS'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://pulsemetrics-demo.example.com',
                'is_featured' => true,
                'sort_order' => 2,
                'gallery' => [
                    'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'mobile-apps',
                'title' => 'Zenith Flow - Daily Habit & Wellness Companion',
                'slug' => 'zenith-flow-habit-wellness-app',
                'client_name' => 'Zenith Life Labs',
                'short_description' => 'Minimalist cross-platform habit tracker with circadian rhythm pacing, haptic streak feedback, and offline sync.',
                'full_description' => 'Zenith Flow was designed to combat cognitive overload by providing a clutter-free, privacy-preserving habit tracking experience. Built with Flutter, it delivers silky 120Hz micro-interactions, local biometric authentication, and seamless encrypted cloud synchronization.',
                'challenge_solution' => "Challenge: Existing habit apps overwhelmed users with aggressive push notifications and overly complex gamification.\n\nSolution: Designed a zen-like, monochrome aesthetic with smart contextual nudge algorithms, achieving a 68% 30-day retention rate.",
                'tech_stack' => ['Flutter', 'Dart', 'Laravel API', 'SQLite', 'RevenueCat', 'Apple HealthKit'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://apps.apple.com/app/zenith-flow',
                'is_featured' => true,
                'sort_order' => 3,
                'gallery' => [
                    'https://images.unsplash.com/photo-1526470608268-f674ce90ebd4?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'desktop-apps',
                'title' => 'OmniCapture 4K Screen Recorder & Studio Editor',
                'slug' => 'omnicapture-screen-recorder',
                'client_name' => 'OmniMedia Technologies',
                'short_description' => 'Lightweight hardware-accelerated screen capture and rapid timeline clipping desktop utility for macOS & Windows.',
                'full_description' => 'OmniCapture is an ultra-fast desktop utility built for software creators, technical educators, and QA engineers. It records 4K 60fps HDR video with near-zero CPU footprint using native GPU encoders, and features instant GIF conversion, automatic cursor spotlighting, and direct cloud links.',
                'challenge_solution' => "Challenge: Heavy recording suites caused frame drops and system lag when testing performance-sensitive 3D applications.\n\nSolution: Built a lightweight native core with custom audio/video capture pipelines, keeping background memory footprint under 85MB.",
                'tech_stack' => ['Electron', 'Rust', 'WebAssembly', 'C++', 'Tailwind CSS', 'FFmpeg'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://omnicapture.example.com',
                'is_featured' => true,
                'sort_order' => 4,
                'gallery' => [
                    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'browser-extensions',
                'title' => 'MarkFast - Web Research & Markdown Clipper',
                'slug' => 'markfast-markdown-web-clipper',
                'client_name' => 'KnowledgeCraft OSS',
                'short_description' => 'Privacy-first Manifest V3 extension extracting clean readability markdown from articles, docs, and code repos with one click.',
                'full_description' => 'MarkFast allows researchers, developers, and writers to capture web content without cookies, ads, or formatting clutter. It intelligently strips boilerplate HTML, converts syntax-highlighted code blocks, and syncs directly into Obsidian, Notion, or local Markdown vaults.',
                'challenge_solution' => "Challenge: The Chrome Web Store Manifest V3 migration deprecated background persistent scripts, breaking existing web scrapers.\n\nSolution: Re-architected data scraping using offscreen document workers and streaming content parsers with zero external tracking dependencies.",
                'tech_stack' => ['Chrome Manifest V3', 'TypeScript', 'Web Workers', 'Readability.js', 'Tailwind CSS'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://chromewebstore.google.com/detail/markfast-clipper',
                'is_featured' => false,
                'sort_order' => 5,
                'gallery' => [
                    'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'web-design',
                'title' => 'Kroma Spatial Design System & Multi-Platform UI Kit',
                'slug' => 'kroma-spatial-design-system',
                'client_name' => 'Kroma Interface Studio',
                'short_description' => 'Comprehensive enterprise design system comprising 300+ accessible components, tokens, and dark/light thematic modes.',
                'full_description' => 'We designed and architected the Kroma Design System to establish complete brand consistency across web, tablet, and mobile touchpoints. Includes WCAG AAA contrast scales, standardized semantic spacing rhythms, fluid typography, and comprehensive Figma token synchronization.',
                'challenge_solution' => "Challenge: Multiple engineering squads were duplicating UI components, leading to brand discrepancies and sluggish development velocity.\n\nSolution: Created a single source of truth Figma token library mapped 1:1 with Tailwind CSS configuration, reducing new feature UI implementation time by 50%.",
                'tech_stack' => ['Figma Tokens', 'Tailwind CSS', 'Storybook', 'Design Tokens (W3C)', 'TypeScript'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://kroma-tokens.example.com',
                'is_featured' => true,
                'sort_order' => 6,
                'gallery' => [
                    'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'web-apps',
                'title' => 'Vanguard Multi-Tenant B2B Billing & Ledger Portal',
                'slug' => 'vanguard-multi-tenant-billing',
                'client_name' => 'Vanguard Financial Services',
                'short_description' => 'Enterprise financial ledger handling complex usage metering, custom discount hierarchies, and automated tax calculation.',
                'full_description' => 'Vanguard provides infrastructure billing for high-growth SaaS companies. We built an audited double-entry accounting ledger backend with an intuitive frontend client portal, providing customer self-serve payment methods, invoice downloads, and granular audit trails.',
                'challenge_solution' => "Challenge: Inaccurate usage reconciliation was causing billing disputes and manual finance team recalculations every month.\n\nSolution: Implemented an idempotent event-driven metering pipeline in Laravel and MySQL with automated cryptographic audit hashing.",
                'tech_stack' => ['Laravel 11', 'MySQL 8', 'Tailwind CSS', 'Livewire', 'Redis Queue', 'Stripe Invoicing'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://vanguard-finance.example.com',
                'is_featured' => false,
                'sort_order' => 7,
                'gallery' => [
                    'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'mobile-apps',
                'title' => 'HyperCourier On-Demand Driver Dispatch & Routing',
                'slug' => 'hypercourier-driver-dispatch',
                'client_name' => 'HyperCourier Express',
                'short_description' => 'Real-time turn-by-turn routing, barcode proof-of-delivery scanner, and dynamic route optimization for couriers.',
                'full_description' => 'Built for thousands of courier drivers on the road daily, HyperCourier optimizes package drop sequence, captures customer digital signatures offline, and calculates real-time traffic detour paths to maximize delivery speed.',
                'challenge_solution' => "Challenge: High driver churn caused by battery drain and app crashes in areas with patchy cellular connectivity.\n\nSolution: Implemented an offline-first SQLite synchronization engine with low-power background location tracking, extending driver phone battery life by 40%.",
                'tech_stack' => ['React Native', 'TypeScript', 'Node.js / Laravel', 'Mapbox GL', 'SQLite'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://hypercourier.example.com',
                'is_featured' => false,
                'sort_order' => 8,
                'gallery' => [
                    'https://images.unsplash.com/photo-1526470608268-f674ce90ebd4?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'desktop-apps',
                'title' => 'DevTunnel Secure Localhost Reverse Proxy Tool',
                'slug' => 'devtunnel-localhost-reverse-proxy',
                'client_name' => 'DevTunnel Tools LLC',
                'short_description' => 'One-click SSL tunnel utility enabling developers to share local servers, inspect webhooks, and replay HTTP traffic.',
                'full_description' => 'DevTunnel is a developer utility designed to streamline webhook testing and remote client review sessions. It spins up end-to-end encrypted HTTP/WebSocket tunnels in milliseconds, inspects payloads in real time, and allows instant request replay.',
                'challenge_solution' => "Challenge: Developers struggled to test third-party webhook callbacks from Stripe and GitHub behind strict corporate firewalls.\n\nSolution: Created a zero-configuration native desktop app with built-in request replay and mock responders, cutting debugging time significantly.",
                'tech_stack' => ['Go (Backend)', 'Electron UI', 'Tailwind CSS', 'TLS / WireGuard', 'SQLite'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://devtunnel.example.com',
                'is_featured' => false,
                'sort_order' => 9,
                'gallery' => [
                    'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            [
                'category_slug' => 'web-development',
                'title' => 'Luminary Capital Global Venture Portal',
                'slug' => 'luminary-capital-venture-portal',
                'client_name' => 'Luminary Capital Partners',
                'short_description' => 'Editorial venture capital brand portal with interactive portfolio map, founder stories, and dynamic pitch submission funnel.',
                'full_description' => 'A high-impact web presence for a Tier-1 venture capital fund. Features smooth editorial typography, dark/light contrast balance, custom interactive SVG maps of global fund investments, and an encrypted pitch deck submission pipeline.',
                'challenge_solution' => "Challenge: The previous WordPress site was vulnerable to spam submissions and lacked mobile refinement.\n\nSolution: Developed a custom Laravel Blade application with Turnstile bot mitigation and automated lead categorization into the investment team's CRM.",
                'tech_stack' => ['Laravel 11', 'Tailwind CSS', 'Alpine.js', 'MySQL', 'Cloudflare Turnstile'],
                'thumbnail_url' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80',
                'external_url' => 'https://luminary-demo.example.com',
                'is_featured' => true,
                'sort_order' => 10,
                'gallery' => [
                    'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
        ];

        foreach ($projectsData as $data) {
            $category = $categories[$data['category_slug']] ?? null;
            if (!$category) {
                continue;
            }

            $gallery = $data['gallery'] ?? [];
            unset($data['category_slug'], $data['gallery']);

            $data['category_id'] = $category->id;

            if (empty($data['problem']) && !empty($data['challenge_solution'])) {
                $parts = explode("\n\nSolution:", $data['challenge_solution']);
                $data['problem'] = trim(str_replace('Challenge:', '', $parts[0] ?? $data['challenge_solution']));
                $data['solution'] = trim($parts[1] ?? 'Architected and deployed a modern cloud-native solution meeting strict SLA benchmarks.');
            }
            if (empty($data['github_url'])) {
                $data['github_url'] = 'https://github.com/agency-demo/' . $data['slug'];
            }

            $project = Project::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            // Seed gallery images
            foreach ($gallery as $index => $imageUrl) {
                ProjectImage::updateOrCreate(
                    [
                        'project_id' => $project->id,
                        'image_url' => $imageUrl,
                    ],
                    [
                        'caption' => $project->title . ' Preview ' . ($index + 1),
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }
    }
}
