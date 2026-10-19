<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $settings = \App\Models\SiteSetting::current();
        $response->assertSeeText($settings->agency_name);
        $response->assertSee($settings->hero_headline);
    }

    public function test_home_page_displays_categories_and_projects(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Web Design & UI/UX');
        $response->assertSee('Web Development');
        $response->assertSee('Web Applications');
        $response->assertSee('Mobile Applications');
        $response->assertSee('Desktop Applications');
        $response->assertSee('Browser Extensions');
    }

    public function test_home_page_displays_proof_and_metrics_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="proof"', false);
        $response->assertSee('On-Time Handover');
        $response->assertSee('15+');
        $response->assertSee('Successful Deliveries');
        $response->assertSee('Tech Debt Guarantee');
        $response->assertSee('24/7');
        $response->assertSee('SLA Support');
        $response->assertSee('Modern Architecture (Laravel, APIs, CI/CD)', false);
        $response->assertSee('Clean & Documented Code', false);
        $response->assertSee('Rigorous QA & Security Testing', false);
        $response->assertSee('Early Client Feedback');
        $response->assertSee('Marcus Vance');
    }
}
