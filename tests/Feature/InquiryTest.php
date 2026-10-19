<?php

namespace Tests\Feature;

use App\Mail\InquiryReceivedMail;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    public function test_user_can_submit_valid_inquiry(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Sophia Williams',
            'email' => 'sophia@techventure.com',
            'service_type' => 'Web Applications',
            'budget_range' => '$10,000 - $25,000',
            'message' => 'We need a high-performance web dashboard built with Laravel and Tailwind.',
        ];

        $response = $this->postJson(route('inquiries.store'), $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Sophia Williams',
            'email' => 'sophia@techventure.com',
            'service_type' => 'Web Applications',
            'status' => 'new',
        ]);

        Mail::assertQueued(InquiryReceivedMail::class);
    }

    public function test_inquiry_requires_mandatory_fields(): void
    {
        $response = $this->postJson(route('inquiries.store'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function test_honeypot_trap_blocks_spam_bots(): void
    {
        $payload = [
            'name' => 'Spam Bot',
            'email' => 'bot@spammer.org',
            'message' => 'Buy cheap links now at this website.',
            'website_url_trap' => 'http://spam.ru',
        ];

        $response = $this->postJson(route('inquiries.store'), $payload);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('inquiries', [
            'email' => 'bot@spammer.org',
        ]);
    }
}
