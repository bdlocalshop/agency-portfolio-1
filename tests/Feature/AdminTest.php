<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_login_page_renders(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_admin_user_can_access_dashboard_and_resources(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@agency.com'],
            [
                'name' => 'Agency Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);

        // Verify resources are accessible
        $this->actingAs($admin)->get('/admin/projects')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/categories')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/inquiries')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/metrics')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/testimonials')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/site-settings')->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_panel(): void
    {
        $regularUser = User::firstOrCreate(
            ['email' => 'client@outside-company.com'],
            [
                'name' => 'Regular Client',
                'password' => Hash::make('secret123'),
                'is_admin' => false,
            ]
        );

        $response = $this->actingAs($regularUser)->get('/admin');
        $response->assertStatus(403);
    }
}
