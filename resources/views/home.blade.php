@extends('layouts.app')

@section('content')
<div x-data="portfolioApp({
    projects: {{ Js::from($projectsJson) }},
    categories: {{ Js::from($categories) }}
})" class="space-y-24 sm:space-y-32">

    <!-- HERO SECTION (Design Reference Adapted) -->
    <section class="pt-6 sm:pt-10 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-white rounded-3xl p-6 sm:p-10 lg:p-16 border border-[#E7E9E2] shadow-xs overflow-hidden">
                
                <!-- Background ambient decorative glow -->
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-[#ECEFE7] rounded-full blur-3xl -z-10 pointer-events-none opacity-60"></div>
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- Top Pill Tag (Matching Reference) -->
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#EAECE6] text-[#373E2E] text-xs font-bold uppercase tracking-wider">
                            <span class="w-2 h-2 rounded-full bg-[#373E2E]"></span>
                            <span>{{ $siteSettings->hero_badge ?? 'Engineering & Digital Product Studio' }}</span>
                        </div>

                        <!-- Massive High-Impact Headline -->
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-[#1F241B] tracking-tight uppercase leading-[1.08]">
                            {{ $siteSettings->hero_headline }}
                        </h1>

                        <!-- Subtitle -->
                        <p class="text-base sm:text-lg text-[#616859] leading-relaxed max-w-2xl font-normal">
                            {{ $siteSettings->hero_subheadline }}
                        </p>

                        <!-- Hero Action Buttons -->
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <a href="{{ $siteSettings->secondary_cta_url ?: '#portfolio' }}"
                               class="inline-flex items-center gap-3 bg-[#23271D] hover:bg-[#151812] text-white font-semibold px-7 py-3.5 rounded-full transition-all duration-300 shadow-sm hover:shadow-md hover:scale-[1.02] text-sm sm:text-base">
                                <span>{{ $siteSettings->secondary_cta_text ?: 'Explore Portfolio' }}</span>
                                <svg class="w-4 h-4 text-[#E2E6DC]" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                            <a href="{{ $siteSettings->primary_cta_url ?: '#contact' }}"
                               class="inline-flex items-center gap-2 bg-[#F1F3ED] hover:bg-[#E4E7DD] text-[#282F20] font-semibold px-6 py-3.5 rounded-full transition-all duration-200 text-sm sm:text-base">
                                <span>{{ $siteSettings->primary_cta_text ?: 'Get Architecture Proposal' }}</span>
                            </a>
                        </div>

                        <!-- Proof Strip beneath CTA -->
                        <div class="pt-4 flex flex-wrap items-center gap-6 text-xs text-[#71786A] font-medium border-t border-[#EEF0EB]">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Sub-second API response standard</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>100% intellectual property ownership</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Zero third-party vendor lock-in</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Hero Visual Composition with Floating Cards (Direct Reference Adaptation) -->
                    <div class="lg:col-span-5 relative">
                        <div class="relative mx-auto max-w-md lg:max-w-none">
                            
                            <!-- Main Featured Image Card (16:10 aspect ratio preserved for CLS prevention) -->
                            <div class="aspect-[16/11] rounded-2xl overflow-hidden shadow-lg border border-[#E2E6DC] bg-[#EAECE6] relative group">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80"
                                     alt="AeroAgency Engineered Systems"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                     loading="eager"
                                     fetchpriority="high"
                                     width="1000"
                                     height="687">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col justify-end p-6">
                                    <span class="text-xs uppercase tracking-widest font-bold text-white/80">Flagship Case Study</span>
                                    <h3 class="text-lg font-bold text-white">PulseMetrics Cloud Fleet Telemetry</h3>
                                </div>
                            </div>

                            <!-- Floating Pill Badge 1: Top Right (Matching Reference) -->
                            <div class="absolute -top-4 -right-4 sm:top-4 sm:-right-6 bg-white/95 backdrop-blur-md px-4 py-3 rounded-2xl shadow-md border border-[#E7E9E2] flex items-center gap-3 animate-float">
                                <div class="w-9 h-9 rounded-xl bg-[#EAECE6] text-[#23271D] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-[#1F241B]">Rapid Delivery</p>
                                    <p class="text-[11px] text-[#71786A]">2–4 Week MVP Sprints</p>
                                </div>
                            </div>

                            <!-- Floating Pill Badge 2: Mid Right -->
                            <div class="hidden sm:flex absolute top-1/2 -right-8 -translate-y-1/2 bg-white/95 backdrop-blur-md px-4 py-3 rounded-2xl shadow-md border border-[#E7E9E2] items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-[#EAECE6] text-[#23271D] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-[#1F241B]">Production Ready</p>
                                    <p class="text-[11px] text-[#71786A]">99.9% Uptime Standard</p>
                                </div>
                            </div>

                            <!-- Floating Rating Card: Bottom Left (Matching Reference Avatar Strip) -->
                            <div class="absolute -bottom-6 -left-4 sm:left-4 bg-white/95 backdrop-blur-md px-4 py-3 rounded-2xl shadow-lg border border-[#E7E9E2] flex items-center gap-3">
                                <div class="flex -space-x-2 overflow-hidden">
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Client 1">
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="Client 2">
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=100&q=80" alt="Client 3">
                                </div>
                                <div class="text-left">
                                    <div class="flex items-center gap-1 text-[#EAB308]">
                                        <span>★★★★★</span>
                                        <span class="text-xs font-bold text-[#1F241B] ml-1">4.9 / 5.0</span>
                                    </div>
                                    <p class="text-[10px] font-semibold text-[#71786A] uppercase tracking-wider">50+ Shipped Apps</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- METRICS & PROOF BAR -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white p-6 rounded-2xl border border-[#E7E9E2] text-center shadow-xs">
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#23271D] tracking-tight">50+</span>
                <span class="text-xs sm:text-sm font-semibold text-[#666C5E] mt-1 block">Production Deployments</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-[#E7E9E2] text-center shadow-xs">
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#23271D] tracking-tight">&lt; 180ms</span>
                <span class="text-xs sm:text-sm font-semibold text-[#666C5E] mt-1 block">Average Server TTFB</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-[#E7E9E2] text-center shadow-xs">
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#23271D] tracking-tight">99.8%</span>
                <span class="text-xs sm:text-sm font-semibold text-[#666C5E] mt-1 block">Client Milestone Adherence</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-[#E7E9E2] text-center shadow-xs">
                <span class="block text-3xl sm:text-4xl font-extrabold text-[#23271D] tracking-tight">6 Platforms</span>
                <span class="text-xs sm:text-sm font-semibold text-[#666C5E] mt-1 block">Full-Stack Specialization</span>
            </div>
        </div>
    </section>

    <!-- DYNAMIC PORTFOLIO SHOWCASE (FR-1.2 & FR-1.3) -->
    <section id="portfolio" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        
        <!-- Section Header with Search Bar (Matching Reference Layout) -->
        <div class="space-y-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#666C5E] mb-1">
                        <span class="w-2 h-2 rounded-full bg-[#444B39]"></span>
                        <span>Curated Case Studies</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-[#1F241B] tracking-tight uppercase">
                        Portfolio & Production Work
                    </h2>
                </div>

                <!-- Instant Search Input Pill (Matching Search Bar from Design Reference) -->
                <div class="relative w-full md:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#71786A]">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           x-model="searchQuery"
                           placeholder="Search by tech or keyword..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-full bg-white border border-[#E7E9E2] text-sm text-[#1F241B] placeholder-[#8E9785] focus:outline-none focus:ring-2 focus:ring-[#23271D] focus:border-transparent transition-all shadow-xs">
                    <button x-show="searchQuery"
                            x-cloak
                            @click="searchQuery = ''"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-xs text-[#71786A] hover:text-[#1F241B]">
                        Clear
                    </button>
                </div>
            </div>

            <!-- Category Filter Pill Chips (Matching Design Reference Chips) -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                <!-- All Filter -->
                <button type="button"
                        @click="selectedCategory = 'all'"
                        class="shrink-0 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wide transition-all duration-200 cursor-pointer flex items-center gap-2 shadow-xs"
                        :class="selectedCategory === 'all' 
                            ? 'bg-[#23271D] text-white' 
                            : 'bg-white hover:bg-[#F1F3ED] text-[#444B39] border border-[#E7E9E2]'">
                    <span>All Work</span>
                    <span class="text-[10px] px-1.5 py-0.5 rounded-full font-bold"
                          :class="selectedCategory === 'all' ? 'bg-white/20 text-white' : 'bg-[#EAECE6] text-[#444B39]'"
                          x-text="projects.length"></span>
                </button>

                <!-- Category Specific Chips -->
                <template x-for="cat in categories" :key="cat.slug">
                    <button type="button"
                            @click="selectedCategory = cat.slug"
                            class="shrink-0 px-4 py-2.5 rounded-full text-xs font-bold uppercase tracking-wide transition-all duration-200 cursor-pointer flex items-center gap-2 shadow-xs"
                            :class="selectedCategory === cat.slug 
                                ? 'bg-[#23271D] text-white' 
                                : 'bg-white hover:bg-[#F1F3ED] text-[#444B39] border border-[#E7E9E2]'">
                        <span x-text="cat.name"></span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded-full font-bold"
                              :class="selectedCategory === cat.slug ? 'bg-white/20 text-white' : 'bg-[#EAECE6] text-[#444B39]'"
                              x-text="cat.projects_count"></span>
                    </button>
                </template>
            </div>
        </div>

        <!-- Filtered Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <template x-for="project in filteredProjects" :key="project.id">
                <div class="group bg-white rounded-2xl border border-[#E7E9E2] overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                    
                    <div>
                        <!-- Project Thumbnail (Strict 16:10 aspect ratio preserved for CLS prevention) -->
                        <div class="aspect-[16/10] bg-[#ECEFE8] relative overflow-hidden">
                            <img :src="project.thumbnail_url"
                                 :alt="project.title"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                 loading="lazy"
                                 width="800"
                                 height="500">
                            
                            <!-- Badges Overlay -->
                            <div class="absolute top-3 left-3 right-3 flex items-center justify-between pointer-events-none">
                                <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-xs text-[#282F20] text-xs font-bold uppercase tracking-wider shadow-xs"
                                      x-text="project.category_name"></span>
                                
                                <span x-show="project.is_featured"
                                      class="px-2.5 py-1 rounded-full bg-[#23271D] text-white text-[10px] font-bold uppercase tracking-wider shadow-xs">
                                    Featured
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-[#787F72]" x-text="project.client_name"></p>
                            
                            <h3 class="text-lg font-bold text-[#1F241B] group-hover:text-[#444B39] transition-colors leading-snug"
                                x-text="project.title"></h3>
                            
                            <p class="text-xs text-[#666C5E] leading-relaxed line-clamp-2"
                               x-text="project.short_description"></p>

                            <!-- Tech Stack Badges -->
                            <div class="flex flex-wrap gap-1.5 pt-2">
                                <template x-for="tech in project.tech_stack.slice(0, 4)" :key="tech">
                                    <span class="px-2.5 py-1 rounded-md bg-[#F4F5F1] text-[#3E4535] text-[11px] font-medium"
                                          x-text="tech"></span>
                                </template>
                                <span x-show="project.tech_stack.length > 4"
                                      class="px-2 py-1 rounded-md bg-[#F4F5F1] text-[#666C5E] text-[10px] font-semibold"
                                      x-text="'+' + (project.tech_stack.length - 4)"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action Trigger -->
                    <div class="p-5 sm:p-6 pt-0">
                        <button type="button"
                                @click="openModal(project)"
                                class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-[#F8F9F6] hover:bg-[#23271D] text-[#23271D] hover:text-white text-xs font-bold uppercase tracking-wider transition-all duration-200 cursor-pointer border border-[#E7E9E2] group-hover:border-[#23271D]">
                            <span>View Case Study</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>

                </div>
            </template>
        </div>

        <!-- Empty Results State -->
        <div x-show="filteredProjects.length === 0"
             x-cloak
             class="bg-white rounded-3xl p-12 text-center border border-[#E7E9E2] space-y-4 my-8">
            <div class="w-12 h-12 rounded-full bg-[#F4F5F1] text-[#666C5E] mx-auto flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <h4 class="text-base font-bold text-[#1F241B]">No matching portfolio projects found</h4>
            <p class="text-xs text-[#71786A] max-w-sm mx-auto">Try clearing your search query or selecting a different service category.</p>
            <button @click="selectedCategory = 'all'; searchQuery = ''"
                    type="button"
                    class="px-5 py-2 rounded-full bg-[#23271D] text-white text-xs font-semibold">
                Reset All Filters
            </button>
        </div>

    </section>

    <!-- SINGLE PROJECT MODAL DIALOG (FR-1.3) -->
    <div x-show="modalOpen"
         x-cloak
         @keydown.escape.window="closeModal()"
         class="fixed inset-0 z-50 overflow-y-auto"
         role="dialog"
         aria-modal="true">
        
        <!-- Modal Backdrop -->
        <div x-show="modalOpen"
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeModal()"
             class="fixed inset-0 bg-black/60 backdrop-blur-xs"></div>

        <!-- Modal Wrapper -->
        <div class="min-h-full flex items-center justify-center p-4 sm:p-6 text-center">
            
            <div x-show="modalOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 @click.stop
                 class="w-full max-w-3xl bg-white rounded-3xl p-6 sm:p-8 text-left shadow-2xl border border-[#E7E9E2] relative space-y-6 my-8">
                
                <!-- Close Button -->
                <button @click="closeModal()"
                        type="button"
                        class="absolute top-5 right-5 w-9 h-9 rounded-full bg-[#F4F5F1] hover:bg-[#23271D] text-[#23271D] hover:text-white flex items-center justify-center transition-colors focus:outline-none"
                        aria-label="Close dialog">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>

                <template x-if="activeProject">
                    <div class="space-y-6">
                        
                        <!-- Header info -->
                        <div class="space-y-2 pr-10">
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full bg-[#EAECE6] text-[#343A2C] text-xs font-bold uppercase tracking-wider"
                                      x-text="activeProject.category_name"></span>
                                <span class="text-xs text-[#71786A] font-semibold" x-text="'• Client: ' + (activeProject.client_name || 'Confidential')"></span>
                            </div>
                            <h3 class="text-xl sm:text-3xl font-extrabold text-[#1F241B] tracking-tight"
                                x-text="activeProject.title"></h3>
                        </div>

                        <!-- Main Image View -->
                        <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-[#ECEFE8] border border-[#E7E9E2]">
                            <img :src="activeImage || activeProject.thumbnail_url"
                                 :alt="activeProject.title"
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- Gallery Thumbnails (if available) -->
                        <template x-if="activeProject.gallery && activeProject.gallery.length > 0">
                            <div class="flex items-center gap-3 overflow-x-auto pb-1">
                                <button type="button"
                                        @click="activeImage = activeProject.thumbnail_url"
                                        class="w-20 h-14 rounded-lg overflow-hidden border-2 shrink-0 transition-all"
                                        :class="activeImage === activeProject.thumbnail_url || !activeImage ? 'border-[#23271D]' : 'border-transparent opacity-60 hover:opacity-100'">
                                    <img :src="activeProject.thumbnail_url" class="w-full h-full object-cover" alt="Main cover">
                                </button>
                                <template x-for="(img, idx) in activeProject.gallery" :key="idx">
                                    <button type="button"
                                            @click="activeImage = img.url"
                                            class="w-20 h-14 rounded-lg overflow-hidden border-2 shrink-0 transition-all"
                                            :class="activeImage === img.url ? 'border-[#23271D]' : 'border-transparent opacity-60 hover:opacity-100'">
                                        <img :src="img.url" class="w-full h-full object-cover" :alt="img.caption || 'Preview'">
                                    </button>
                                </template>
                            </div>
                        </template>

                        <!-- Problem & Solution Statement -->
                        <div class="bg-[#F8F9F6] p-5 sm:p-6 rounded-2xl border border-[#E7E9E2] space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#444B39]">Architecture & Case Study Breakdown</h4>
                            
                            <template x-if="activeProject.problem || activeProject.solution">
                                <div class="space-y-4">
                                    <template x-if="activeProject.problem">
                                        <div class="space-y-1">
                                            <span class="inline-block text-[11px] font-bold text-[#1F241B] uppercase tracking-wider px-2 py-0.5 rounded-sm bg-[#EAECE6]">Architectural Challenge</span>
                                            <div class="text-xs sm:text-sm text-[#3E4535] leading-relaxed prose prose-sm max-w-none pt-1" x-html="activeProject.problem"></div>
                                        </div>
                                    </template>
                                    <template x-if="activeProject.solution">
                                        <div class="space-y-1 pt-3 border-t border-[#EAECE6]">
                                            <span class="inline-block text-[11px] font-bold text-emerald-800 uppercase tracking-wider px-2 py-0.5 rounded-sm bg-emerald-50">Engineering Solution</span>
                                            <div class="text-xs sm:text-sm text-[#3E4535] leading-relaxed prose prose-sm max-w-none pt-1" x-html="activeProject.solution"></div>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="!activeProject.problem && !activeProject.solution">
                                <p class="text-xs sm:text-sm text-[#3E4535] leading-relaxed whitespace-pre-line"
                                   x-text="activeProject.challenge_solution || activeProject.full_description"></p>
                            </template>
                        </div>

                        <!-- Tech Stack Badges in Modal -->
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#787F72] mb-2">Technologies Deployed</h4>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="tech in activeProject.tech_stack" :key="tech">
                                    <span class="px-3 py-1 rounded-full bg-[#EAECE6] text-[#282F20] text-xs font-medium"
                                          x-text="tech"></span>
                                </template>
                            </div>
                        </div>

                        <!-- Modal Actions Footer -->
                        <div class="pt-4 border-t border-[#EEF0EB] flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <template x-if="activeProject.external_url">
                                    <a :href="activeProject.external_url"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1.5 text-xs font-bold text-[#23271D] hover:underline uppercase tracking-wide">
                                        <span>Live Demo</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </a>
                                </template>

                                <template x-if="activeProject.github_url">
                                    <a :href="activeProject.github_url"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1.5 text-xs font-bold text-[#616859] hover:text-[#23271D] hover:underline uppercase tracking-wide">
                                        <span>Repository</span>
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                        </svg>
                                    </a>
                                </template>
                            </div>

                            <a href="#contact"
                               @click="closeModal()"
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#23271D] hover:bg-[#151812] text-white text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-full transition-all shadow-sm">
                                <span>Build Similar Software With Us</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </template>

            </div>
        </div>
    </div>

    <!-- CAPABILITIES & PROCESS / HOW WE WORK STRIP (Matching Technology Strip in Reference) -->
    <section id="capabilities" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <div id="process" class="scroll-mt-24 -mt-24 pt-24" aria-hidden="true"></div>
        
        <div class="mb-10 text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-[#666C5E]">High-Performance Principles</span>
            <h2 class="text-2xl sm:text-4xl font-black text-[#1F241B] tracking-tight uppercase">
                Engineering Discipline
            </h2>
            <p class="text-xs sm:text-sm text-[#71786A]">Every system we ship adheres to rigorous production standards designed for zero maintenance drag.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Item 1 -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E7E9E2] space-y-3 hover:border-[#23271D] transition-colors shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#F4F5F1] text-[#23271D] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1F241B]">Lean VPS & Serverless Core</h3>
                <p class="text-xs text-[#666C5E] leading-relaxed">Engineered to operate on minimal hosting infrastructure with no expensive recurring SaaS dependencies.</p>
            </div>

            <!-- Item 2 -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E7E9E2] space-y-3 hover:border-[#23271D] transition-colors shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#F4F5F1] text-[#23271D] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1F241B]">Figma Tokens to Tailwind</h3>
                <p class="text-xs text-[#666C5E] leading-relaxed">Direct translation from high-fidelity design tokens into semantic utility classes without stylesheet bloat.</p>
            </div>

            <!-- Item 3 -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E7E9E2] space-y-3 hover:border-[#23271D] transition-colors shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#F4F5F1] text-[#23271D] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1F241B]">Sub-Second Edge Speeds</h3>
                <p class="text-xs text-[#666C5E] leading-relaxed">High PageSpeed scores ($\ge 95$ Desktop, $\ge 85$ Mobile) achieved via asset minimization, WebP, and edge caching.</p>
            </div>

            <!-- Item 4 -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E7E9E2] space-y-3 hover:border-[#23271D] transition-colors shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#F4F5F1] text-[#23271D] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1F241B]">Cross-Platform Native</h3>
                <p class="text-xs text-[#666C5E] leading-relaxed">Unified architectures powering iOS, Android, macOS, and Windows with fluid 60fps gesture response.</p>
            </div>

            <!-- Item 5 -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E7E9E2] space-y-3 hover:border-[#23271D] transition-colors shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#F4F5F1] text-[#23271D] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1F241B]">Automated Bot Mitigation</h3>
                <p class="text-xs text-[#666C5E] leading-relaxed">Integrated Cloudflare Turnstile verification and honeypots without degrading real user conversion rates.</p>
            </div>

            <!-- Item 6 -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E7E9E2] space-y-3 hover:border-[#23271D] transition-colors shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-[#F4F5F1] text-[#23271D] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1F241B]">Clean Code & Docs</h3>
                <p class="text-xs text-[#666C5E] leading-relaxed">Strict adherence to PSR standards, automated tests, typed migrations, and crystal-clear architecture specs.</p>
            </div>

        </div>
    </section>

    <!-- PARTNERSHIP VALUE STRIP (Matching "Aero Step Club" Card from Reference) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-[#2D3325] via-[#23271D] to-[#171A13] text-white rounded-3xl p-8 sm:p-12 border border-[#3C4432] shadow-xl relative overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-8 space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#B5BFAC]">Agency Direct Partnership</span>
                    <h3 class="text-2xl sm:text-3xl font-black uppercase tracking-tight text-white">
                        Dedicated Senior Developers. No Junior Hand-offs.
                    </h3>
                    <p class="text-sm text-[#AAB4A1] max-w-xl leading-relaxed">
                        When you work with AeroAgency, your codebase is architected by seasoned full-stack engineers with deep Laravel, Vue, Flutter, and Electron expertise. We quote transparently and deliver deterministically.
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4">
                        <div class="bg-white/5 border border-white/10 rounded-xl p-3">
                            <span class="block text-xs font-bold text-white">100% Code Ownership</span>
                            <span class="text-[10px] text-[#AAB4A1]">Your Git repositories</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-3">
                            <span class="block text-xs font-bold text-white">Fixed-Price Sprints</span>
                            <span class="text-[10px] text-[#AAB4A1]">No surprise invoices</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-3">
                            <span class="block text-xs font-bold text-white">30-Day Warranty</span>
                            <span class="text-[10px] text-[#AAB4A1]">Post-launch support</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-3">
                            <span class="block text-xs font-bold text-white">Direct Slack/Discord</span>
                            <span class="text-[10px] text-[#AAB4A1]">No middle managers</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 text-center lg:text-right">
                    <a href="#contact"
                       class="inline-block bg-[#E2E6DC] hover:bg-white text-[#23271D] font-bold text-sm sm:text-base px-8 py-4 rounded-full transition-all duration-200 shadow-md hover:scale-[1.02]">
                        Discuss Your Project &rarr;
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- PROOF & METRICS SECTION (Dedicated id="proof") -->
    <section id="proof" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24 space-y-12">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-2">
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#666C5E]">
                <span class="w-2 h-2 rounded-full bg-[#373E2E]"></span>
                <span>Track Record & Verification</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-black text-[#1F241B] tracking-tight uppercase">
                Proof & Performance Metrics
            </h2>
            <p class="text-xs sm:text-sm text-[#71786A] max-w-xl mx-auto">
                Real engineering outcomes backed by stringent technical benchmarks, milestone delivery guarantees, and direct feedback from founding teams.
            </p>
        </div>

        <!-- 1. Key Metrics Strip (4-column responsive grid, collapses to 2x2 on mobile) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($metrics as $metric)
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E7E9E2] text-center shadow-xs hover:border-[#23271D] transition-colors group">
                    <span class="block text-3xl sm:text-4xl lg:text-5xl font-black text-[#23271D] tracking-tight group-hover:scale-105 transition-transform duration-300">
                        {{ data_get($metric, 'value') }}
                    </span>
                    <span class="text-xs sm:text-sm font-bold text-[#1F241B] mt-2 block">
                        {{ data_get($metric, 'label') }}
                    </span>
                    @if(data_get($metric, 'description'))
                        <span class="text-[11px] text-[#71786A] mt-1 block">
                            {{ data_get($metric, 'description') }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- 2. Standards & Trust Badges (Proof of Quality) -->
        <div class="bg-[#F8F9F6] p-6 sm:p-8 rounded-3xl border border-[#E7E9E2] space-y-6">
            <div class="text-center">
                <span class="text-xs font-bold uppercase tracking-wider text-[#666C5E]">Our Engineering Standards</span>
                <h3 class="text-lg sm:text-xl font-extrabold text-[#1F241B]">Verified Quality Assurance Criteria</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-2xl border border-[#E7E9E2] shadow-xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-[#EAECE6] text-[#23271D] flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-[#1F241B]">Modern Architecture (Laravel, APIs, CI/CD)</h4>
                    <p class="text-xs text-[#666C5E] leading-relaxed">
                        Built on proven foundational stacks: modern Laravel, Alpine.js, Tailwind CSS, Redis queues, and automated GitHub Action deployments.
                    </p>
                    <div class="flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <span>Automated CI Testing & Zero Downtime Deploys</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-[#E7E9E2] shadow-xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-[#EAECE6] text-[#23271D] flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-[#1F241B]">Clean & Documented Code</h4>
                    <p class="text-xs text-[#666C5E] leading-relaxed">
                        Every endpoint, model relationship, and service method includes strict PHP type declarations, docblocks, and comprehensive architectural READMEs.
                    </p>
                    <div class="flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <span>PSR-12 Compliance & Typed Interfaces</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-[#E7E9E2] shadow-xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-[#EAECE6] text-[#23271D] flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-[#1F241B]">Rigorous QA & Security Testing</h4>
                    <p class="text-xs text-[#666C5E] leading-relaxed">
                        Automated feature test coverage, Cloudflare Turnstile bot shielding, CSRF token authentication, and SQL injection sanitization by default.
                    </p>
                    <div class="flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <span>Automated PHPUnit Tests & Rate Limiting</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- 3. Early Client Feedback / Testimonials Slot -->
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#666C5E]">Client Endorsements</span>
                    <h3 class="text-xl sm:text-3xl font-black text-[#1F241B] tracking-tight uppercase">
                        Early Client Feedback
                    </h3>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-[#373E2E]">
                    <span class="text-amber-500 text-sm">★★★★★</span>
                    <span>5.0 / 5.0 Rating Across 15+ Engagements</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white p-6 sm:p-7 rounded-2xl border border-[#E7E9E2] shadow-xs flex flex-col justify-between hover:shadow-md transition-shadow">
                        <div class="space-y-4">
                            <!-- Star rating + Metric badge -->
                            <div class="flex items-center justify-between">
                                <div class="text-amber-500 text-xs tracking-wider">
                                    @for($i = 0; $i < (int) data_get($testimonial, 'rating', 5); $i++)
                                        ★
                                    @endfor
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full bg-[#EAECE6] text-[#343A2C] text-[10px] font-bold uppercase tracking-wider">
                                    Verified Client
                                </span>
                            </div>

                            <!-- Quote -->
                            <p class="text-xs sm:text-sm text-[#3E4535] leading-relaxed italic">
                                &ldquo;{{ data_get($testimonial, 'quote') ?? data_get($testimonial, 'outcome') }}&rdquo;
                            </p>
                        </div>

                        <!-- Client Identity -->
                        <div class="flex items-center gap-3 pt-5 mt-4 border-t border-[#F1F3ED]">
                            @if(data_get($testimonial, 'avatar_url'))
                                <img src="{{ data_get($testimonial, 'avatar_url') }}"
                                     alt="{{ data_get($testimonial, 'client_name') }}"
                                     class="w-10 h-10 rounded-full object-cover ring-2 ring-[#E7E9E2]">
                            @else
                                <div class="w-10 h-10 rounded-full bg-[#23271D] text-white flex items-center justify-center font-bold text-xs ring-2 ring-[#E7E9E2]">
                                    {{ substr(data_get($testimonial, 'client_name', 'C'), 0, 1) }}
                                </div>
                            @endif
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-[#1F241B]">{{ data_get($testimonial, 'client_name') }}</span>
                                <span class="text-[11px] text-[#71786A]">{{ data_get($testimonial, 'role_company') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <!-- CONTACT & LEAD INGESTION FORM (FR-1.4) -->
    <section id="contact" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="bg-white rounded-3xl p-6 sm:p-10 lg:p-16 border border-[#E7E9E2] shadow-xs">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">
                
                <!-- Left Details -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#666C5E]">Start a Conversation</span>
                        <h2 class="text-2xl sm:text-4xl font-black text-[#1F241B] tracking-tight uppercase">
                            Tell Us About Your Next Project.
                        </h2>
                    </div>

                    <p class="text-sm text-[#666C5E] leading-relaxed">
                        Whether you are building a new MVP from scratch, modernizing existing enterprise software, or need a white-label engineering partner, let's discuss your timeline and scope.
                    </p>

                    <!-- Contact Details Box -->
                    <div class="space-y-4 pt-4 border-t border-[#EEF0EB]">
                        <div class="flex items-center gap-3 text-sm">
                            <div class="w-8 h-8 rounded-lg bg-[#F4F5F1] text-[#23271D] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-xs text-[#71786A]">Direct Email</span>
                                <a href="mailto:contact@aeroagency.dev" class="font-bold text-[#1F241B] hover:underline">contact@aeroagency.dev</a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 text-sm">
                            <div class="w-8 h-8 rounded-lg bg-[#F4F5F1] text-[#23271D] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-xs text-[#71786A]">Guaranteed SLA</span>
                                <span class="font-bold text-[#1F241B]">Detailed response within 24 hours</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Contact Form (Asynchronous Alpine.js handler) -->
                <div class="lg:col-span-7">
                    <form @submit.prevent="submitForm()"
                          x-data="contactFormHandler()"
                          class="space-y-5">
                        
                        <!-- Inline Success Banner -->
                        <div x-show="submitted"
                             x-cloak
                             x-transition
                             class="p-5 rounded-2xl bg-[#EAF5E9] border border-[#BFDFBC] text-[#1B4D17] text-sm space-y-2">
                            <div class="flex items-center gap-2 font-bold">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Inquiry Dispatched Successfully!</span>
                            </div>
                            <p class="text-xs" x-text="successMessage"></p>
                        </div>

                        <!-- Inline Error Banner -->
                        <div x-show="errorMessage"
                             x-cloak
                             x-transition
                             class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs">
                            <span x-text="errorMessage"></span>
                        </div>

                        <!-- Name and Email Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#373E2E] mb-1.5">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       x-model="formData.name"
                                       required
                                       maxlength="150"
                                       placeholder="Jane Doe"
                                       class="w-full px-4 py-3 rounded-xl bg-[#F8F9F6] border border-[#E7E9E2] text-sm text-[#1F241B] focus:outline-none focus:ring-2 focus:ring-[#23271D] focus:border-transparent transition-all">
                                <span x-show="errors.name" class="text-[11px] text-red-600 mt-1 block" x-text="errors.name ? errors.name[0] : ''"></span>
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#373E2E] mb-1.5">
                                    Work Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       x-model="formData.email"
                                       required
                                       maxlength="255"
                                       placeholder="jane@company.com"
                                       class="w-full px-4 py-3 rounded-xl bg-[#F8F9F6] border border-[#E7E9E2] text-sm text-[#1F241B] focus:outline-none focus:ring-2 focus:ring-[#23271D] focus:border-transparent transition-all">
                                <span x-show="errors.email" class="text-[11px] text-red-600 mt-1 block" x-text="errors.email ? errors.email[0] : ''"></span>
                            </div>
                        </div>

                        <!-- Service Category & Budget Dropdowns -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="service_type" class="block text-xs font-bold uppercase tracking-wider text-[#373E2E] mb-1.5">
                                    Service Scope
                                </label>
                                <select id="service_type"
                                        name="service_type"
                                        x-model="formData.service_type"
                                        class="w-full px-4 py-3 rounded-xl bg-[#F8F9F6] border border-[#E7E9E2] text-sm text-[#1F241B] focus:outline-none focus:ring-2 focus:ring-[#23271D] focus:border-transparent transition-all">
                                    <option value="">Select a service category...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                    <option value="Full-Stack Discovery / Other">Full-Stack Discovery / Other</option>
                                </select>
                            </div>

                            <div>
                                <label for="budget_range" class="block text-xs font-bold uppercase tracking-wider text-[#373E2E] mb-1.5">
                                    Approximate Budget
                                </label>
                                <select id="budget_range"
                                        name="budget_range"
                                        x-model="formData.budget_range"
                                        class="w-full px-4 py-3 rounded-xl bg-[#F8F9F6] border border-[#E7E9E2] text-sm text-[#1F241B] focus:outline-none focus:ring-2 focus:ring-[#23271D] focus:border-transparent transition-all">
                                    <option value="">Select an investment tier...</option>
                                    <option value="$5,000 - $10,000">$5,000 — $10,000 (Sprint MVP)</option>
                                    <option value="$10,000 - $25,000">$10,000 — $25,000 (Full Platform)</option>
                                    <option value="$25,000 - $50,000">$25,000 — $50,000 (Scaleup SaaS)</option>
                                    <option value="$50,000+">$50,000+ (Enterprise Subcontract)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Message Textarea -->
                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-[#373E2E] mb-1.5">
                                Project Scope & Objectives <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message"
                                      name="message"
                                      rows="4"
                                      x-model="formData.message"
                                      required
                                      maxlength="2000"
                                      placeholder="Briefly describe what you're looking to build, your timeline, or any existing repositories..."
                                      class="w-full px-4 py-3 rounded-xl bg-[#F8F9F6] border border-[#E7E9E2] text-sm text-[#1F241B] focus:outline-none focus:ring-2 focus:ring-[#23271D] focus:border-transparent transition-all"></textarea>
                            <span x-show="errors.message" class="text-[11px] text-red-600 mt-1 block" x-text="errors.message ? errors.message[0] : ''"></span>
                        </div>

                        <!-- Invisible Honeypot Field (FR-1.4 Spam Defense) -->
                        <div class="hidden" aria-hidden="true" style="display:none !important;">
                            <input type="text"
                                   name="website_url_trap"
                                   x-model="formData.website_url_trap"
                                   tabindex="-1"
                                   autocomplete="off">
                        </div>

                        <!-- Cloudflare Turnstile Container -->
                        @if(env('CLOUDFLARE_TURNSTILE_SITE_KEY'))
                            <div class="pt-1">
                                <div class="cf-turnstile"
                                     data-sitekey="{{ env('CLOUDFLARE_TURNSTILE_SITE_KEY') }}"
                                     data-callback="onTurnstileSuccess"></div>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit"
                                    :disabled="loading"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-[#23271D] hover:bg-[#151812] disabled:opacity-50 text-white font-semibold text-sm px-8 py-3.5 rounded-full transition-all duration-200 shadow-sm cursor-pointer">
                                <span x-show="!loading">Send Project Inquiry</span>
                                <span x-show="loading" x-cloak class="flex items-center gap-2">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Transmitting...
                                </span>
                                <svg x-show="!loading" class="w-4 h-4 text-[#E2E6DC]" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </section>

</div>

<script>
    // Turnstile global callback
    window.turnstileToken = null;
    function onTurnstileSuccess(token) {
        window.turnstileToken = token;
    }

    // Portfolio State
    function portfolioApp(data) {
        return {
            projects: data.projects || [],
            categories: data.categories || [],
            selectedCategory: 'all',
            searchQuery: '',
            modalOpen: false,
            activeProject: null,
            activeImage: null,

            get filteredProjects() {
                return this.projects.filter(project => {
                    // Category filter
                    const matchesCategory = this.selectedCategory === 'all' || project.category_slug === this.selectedCategory;
                    
                    // Search query filter
                    if (!this.searchQuery.trim()) return matchesCategory;

                    const q = this.searchQuery.toLowerCase();
                    const matchesSearch = project.title.toLowerCase().includes(q) ||
                                          project.short_description.toLowerCase().includes(q) ||
                                          (project.client_name && project.client_name.toLowerCase().includes(q)) ||
                                          project.tech_stack.some(t => t.toLowerCase().includes(q));

                    return matchesCategory && matchesSearch;
                });
            },

            openModal(project) {
                this.activeProject = project;
                this.activeImage = project.thumbnail_url;
                this.modalOpen = true;
                document.body.style.overflow = 'hidden';
            },

            closeModal() {
                this.modalOpen = false;
                this.activeProject = null;
                this.activeImage = null;
                document.body.style.overflow = '';
            }
        };
    }

    // Contact Form AJAX Handler
    function contactFormHandler() {
        return {
            formData: {
                name: '',
                email: '',
                service_type: '',
                budget_range: '',
                message: '',
                website_url_trap: ''
            },
            loading: false,
            submitted: false,
            successMessage: '',
            errorMessage: '',
            errors: {},

            async submitForm() {
                this.loading = true;
                this.errorMessage = '';
                this.errors = {};

                const payload = { ...this.formData };
                if (window.turnstileToken) {
                    payload['cf-turnstile-response'] = window.turnstileToken;
                }

                try {
                    const response = await fetch("{{ route('inquiries.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        if (response.status === 422 && result.errors) {
                            this.errors = result.errors;
                            this.errorMessage = 'Please correct the highlighted errors below.';
                        } else {
                            this.errorMessage = result.message || 'An unexpected error occurred. Please try again.';
                        }
                    } else {
                        this.submitted = true;
                        this.successMessage = result.message;
                        this.formData = {
                            name: '',
                            email: '',
                            service_type: '',
                            budget_range: '',
                            message: '',
                            website_url_trap: ''
                        };
                    }
                } catch (error) {
                    this.errorMessage = 'Network connection issue. Please check your connectivity and try again.';
                } finally {
                    this.loading = false;
                }
            }
        };
    }
</script>
@endsection
