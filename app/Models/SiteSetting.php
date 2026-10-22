<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_name',
        'tagline',
        'site_logo',
        'favicon',
        'hero_badge',
        'hero_headline',
        'hero_subheadline',
        'primary_cta_text',
        'primary_cta_url',
        'secondary_cta_text',
        'secondary_cta_url',
        'contact_email',
        'contact_phone',
        'contact_location',
        'github_url',
        'linkedin_url',
        'x_url',
    ];

    /**
     * Get or create the singleton site settings record.
     */
    public static function current(): self
    {
        return static::firstOrCreate([], [
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
        ]);
    }

    public function getLogoUrlAttribute(): ?string
    {
        if (empty($this->site_logo)) {
            return null;
        }

        if (str_starts_with($this->site_logo, 'http://') || str_starts_with($this->site_logo, 'https://')) {
            return $this->site_logo;
        }

        if (str_starts_with($this->site_logo, 'storage/')) {
            return asset($this->site_logo);
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->site_logo);
    }

    public function getFaviconUrlAttribute(): ?string
    {
        if (empty($this->favicon)) {
            return null;
        }

        if (str_starts_with($this->favicon, 'http://') || str_starts_with($this->favicon, 'https://')) {
            return $this->favicon;
        }

        if (str_starts_with($this->favicon, 'storage/')) {
            return asset($this->favicon);
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->favicon);
    }
}
