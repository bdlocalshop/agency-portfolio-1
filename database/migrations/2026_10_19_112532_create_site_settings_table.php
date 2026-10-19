<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('agency_name')->default('AeroAgency');
            $table->string('tagline')->nullable()->default('Software Engineering Studio');
            $table->string('site_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('hero_badge')->nullable()->default('Software Engineering Studio');
            $table->string('hero_headline')->default('Engineering High-Performance Digital Products.');
            $table->text('hero_subheadline')->nullable();
            $table->string('primary_cta_text')->default('Get Architecture Proposal');
            $table->string('primary_cta_url')->default('#contact');
            $table->string('secondary_cta_text')->default('Explore Case Studies');
            $table->string('secondary_cta_url')->default('#portfolio');
            $table->string('contact_email')->default('hello@aeroagency.dev');
            $table->string('contact_phone')->nullable()->default('+1 (555) 019-2834');
            $table->string('contact_location')->nullable()->default('San Francisco, CA & Remote Global');
            $table->string('github_url')->nullable()->default('https://github.com');
            $table->string('linkedin_url')->nullable()->default('https://linkedin.com');
            $table->string('x_url')->nullable()->default('https://x.com');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
