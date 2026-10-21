@php
    $currentSettings = $siteSettings ?? \App\Models\SiteSetting::current();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $currentSettings->agency_name }} — {{ $currentSettings->tagline }}</title>
    <meta name="description" content="We engineer production-grade web applications, mobile apps, desktop utilities, and browser extensions built for speed, durability, and commercial scale.">
    @if($currentSettings->favicon_url)
        <link rel="icon" href="{{ $currentSettings->favicon_url }}">
    @endif
    
    <!-- Open Graph / Social Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $currentSettings->agency_name }} — Software Architecture & Digital Product Studio">
    <meta property="og:description" content="High-performance web, mobile, desktop apps and browser extensions.">
    <meta property="og:image" content="{{ asset('images/og-preview.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="bg-[#F8F9F6] text-[#1F241B] antialiased selection:bg-[#23271D] selection:text-white min-h-screen flex flex-col justify-between"
      x-data="{ mobileMenuOpen: false, scrolled: false }"
      @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Top Announcement Strip (Design Reference Inspired) -->
    <div class="bg-[#23271D] text-[#E2E6DC] text-xs py-2 px-4 text-center font-medium tracking-wide border-b border-[#33392B]">
        <div class="max-w-7xl mx-auto flex items-center justify-center gap-2">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>Q4 Availability Open — Accepting select MVP builds & full-stack software subcontracting</span>
            <a href="#contact" class="underline underline-offset-2 ml-1 hover:text-white font-semibold transition-colors">Book Discovery &rarr;</a>
        </div>
    </div>

    <!-- Sticky Navigation Bar -->
    <header class="sticky top-0 z-40 transition-all duration-300 border-b"
            :class="scrolled ? 'bg-white/90 backdrop-blur-md border-[#E7E9E2] shadow-xs py-3' : 'bg-[#F8F9F6]/95 backdrop-blur-xs border-transparent py-4'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- Brand Logo (Minimal Geometric Aesthetic or Uploaded Logo) -->
                <a href="{{ route('home') }}" class="group flex items-center gap-3">
                    @if($currentSettings->logo_url)
                        <img src="{{ $currentSettings->logo_url }}" alt="{{ $currentSettings->agency_name }}" class="h-10 w-auto object-contain">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-[#23271D] text-white flex items-center justify-center shadow-xs transition-transform group-hover:scale-105 duration-200">
                            <svg class="w-5 h-5 text-[#E2E6DC]" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                            </svg>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="font-extrabold text-lg tracking-tight text-[#1F241B] leading-none">{{ $currentSettings->agency_name }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#787F72] mt-0.5">{{ $currentSettings->tagline }}</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#portfolio" class="text-sm font-semibold text-[#4F5643] hover:text-[#1F241B] transition-colors">Portfolio</a>
                    <a href="#capabilities" class="text-sm font-semibold text-[#4F5643] hover:text-[#1F241B] transition-colors">Capabilities</a>
                    <a href="#process" class="text-sm font-semibold text-[#4F5643] hover:text-[#1F241B] transition-colors">Engineering Process</a>
                    <a href="#proof" class="text-sm font-semibold text-[#4F5643] hover:text-[#1F241B] transition-colors">Proof & Metrics</a>
                    <a href="#contact" class="text-sm font-semibold text-[#4F5643] hover:text-[#1F241B] transition-colors">Contact</a>
                </nav>

                <!-- Right Action Button -->
                <div class="hidden sm:flex items-center gap-4">
                    <a href="#contact"
                       class="inline-flex items-center gap-2 bg-[#23271D] hover:bg-[#151812] text-white text-sm font-medium px-5 py-2.5 rounded-full transition-all duration-200 shadow-sm hover:shadow-md hover:scale-[1.02]">
                        <span>Start a Project</span>
                        <svg class="w-4 h-4 text-[#E2E6DC]" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            type="button"
                            class="p-2 rounded-xl text-[#23271D] hover:bg-[#EAECE6] transition-colors focus:outline-none"
                            aria-label="Toggle Navigation">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-b border-[#E7E9E2] bg-white px-4 pt-3 pb-6 space-y-3 shadow-lg">
            <a href="#portfolio" @click="mobileMenuOpen = false" class="block py-2 text-base font-semibold text-[#1F241B] hover:text-[#5B6350]">Portfolio Showcase</a>
            <a href="#capabilities" @click="mobileMenuOpen = false" class="block py-2 text-base font-semibold text-[#1F241B] hover:text-[#5B6350]">Capabilities & Tech</a>
            <a href="#process" @click="mobileMenuOpen = false" class="block py-2 text-base font-semibold text-[#1F241B] hover:text-[#5B6350]">How We Work</a>
            <a href="#proof" @click="mobileMenuOpen = false" class="block py-2 text-base font-semibold text-[#1F241B] hover:text-[#5B6350]">Proof & Metrics</a>
            <a href="#contact" @click="mobileMenuOpen = false" class="block py-2 text-base font-semibold text-[#1F241B] hover:text-[#5B6350]">Get In Touch</a>
            <div class="pt-2">
                <a href="#contact" @click="mobileMenuOpen = false" class="w-full inline-flex items-center justify-center gap-2 bg-[#23271D] text-white text-sm font-semibold py-3 rounded-full">
                    <span>Start a Project</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Footer (Matching Reference Structural Rhythm) -->
    <footer class="bg-[#1B1E16] text-[#A6AEA0] pt-16 pb-12 border-t border-[#292F22] mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-[#2D3326]">
                
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="{{ route('home') }}" class="group flex items-center gap-3">
                        @if($currentSettings->logo_url)
                            <img src="{{ $currentSettings->logo_url }}" alt="{{ $currentSettings->agency_name }}" class="h-9 w-auto object-contain">
                        @else
                            <div class="w-9 h-9 rounded-xl bg-white text-[#23271D] flex items-center justify-center font-black">
                                <svg class="w-5 h-5 text-[#23271D]" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <span class="font-extrabold text-xl tracking-tight text-white leading-none">{{ $currentSettings->agency_name }}</span>
                            @if($currentSettings->tagline)
                                <span class="text-[10px] font-bold uppercase tracking-widest text-[#8E9785] mt-1">{{ $currentSettings->tagline }}</span>
                            @endif
                        </div>
                    </a>
                    <p class="text-sm leading-relaxed max-w-sm text-[#8E9785]">
                        {{ $currentSettings->hero_subheadline ?? 'High-velocity digital engineering studio. We partner with founders, venture-backed scaleups, and enterprise businesses to craft production-grade web, mobile, desktop software and browser extensions.' }}
                    </p>
                    <div class="flex items-center gap-3 text-white pt-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        <span class="text-xs font-medium text-[#C2C9BD]">Direct human response in &lt; 24h</span>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#portfolio" class="hover:text-white transition-colors">Web Design & UI/UX</a></li>
                        <li><a href="#portfolio" class="hover:text-white transition-colors">Web Development</a></li>
                        <li><a href="#portfolio" class="hover:text-white transition-colors">Cloud Web Applications</a></li>
                        <li><a href="#portfolio" class="hover:text-white transition-colors">Mobile Apps (iOS/Android)</a></li>
                        <li><a href="#portfolio" class="hover:text-white transition-colors">Native Desktop Software</a></li>
                        <li><a href="#portfolio" class="hover:text-white transition-colors">Chrome Extensions</a></li>
                    </ul>
                </div>

                <!-- Col 3: Principles -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">Engineering</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#capabilities" class="hover:text-white transition-colors">Zero-Latency Architecture</a></li>
                        <li><a href="#capabilities" class="hover:text-white transition-colors">WCAG AA Accessibility</a></li>
                        <li><a href="#capabilities" class="hover:text-white transition-colors">Automated CI/CD Pipelines</a></li>
                        <li><a href="#capabilities" class="hover:text-white transition-colors">Cloudflare Edge Defense</a></li>
                        <li><a href="#process" class="hover:text-white transition-colors">Fixed-Scope MVP Delivery</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Inquiries -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">Direct Connect</h4>
                    <p class="text-sm text-[#8E9785]">Ready to kick off a project or request subcontracting capacity?</p>
                    <div class="pt-1">
                        <a href="mailto:{{ $currentSettings->contact_email }}" class="text-sm font-semibold text-white hover:underline">{{ $currentSettings->contact_email }}</a>
                    </div>
                    @if($currentSettings->contact_phone)
                        <div class="text-xs text-[#8E9785] pt-0.5">
                            {{ $currentSettings->contact_phone }}
                        </div>
                    @endif
                    <div class="text-xs text-[#8E9785] pt-1">
                        {{ $currentSettings->contact_location ?: 'Mon — Fri • 09:00 — 19:00 UTC' }}
                    </div>
                </div>
            </div>

            <!-- Bottom Disclaimer & Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#71786A]">
                <div>
                    &copy; {{ date('Y') }} {{ $currentSettings->agency_name }}. All rights reserved. Built with Laravel 11, Tailwind CSS & FilamentPHP.
                </div>
                <div class="flex items-center gap-6">
                    <a href="#contact" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#contact" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="/admin" class="hover:text-white font-medium transition-colors text-emerald-400">Admin Portal &rarr;</a>
                    <a href="#portfolio" class="hover:text-white transition-colors">Back to Top &uarr;</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
