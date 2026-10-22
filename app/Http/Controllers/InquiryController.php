<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Mail\InquiryReceivedMail;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    /**
     * Store a newly created inquiry in storage.
     */
    public function store(StoreInquiryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // 1. Invisible Honeypot verification
        if (!empty($validated['website_url_trap'])) {
            Log::warning('Honeypot trap triggered by IP: ' . $request->ip());
            return response()->json([
                'success' => false,
                'message' => 'Spam verification failed.',
            ], 422);
        }

        // 2. Cloudflare Turnstile verification (if provided & configured)
        $turnstileResponse = $request->input('cf-turnstile-response');
        $turnstileSecret = config('services.turnstile.secret_key', env('CLOUDFLARE_TURNSTILE_SECRET_KEY'));

        if (!empty($turnstileSecret) && !str_starts_with($turnstileSecret, '1x0000000000000000000000000000000AA') && !empty($turnstileResponse)) {
            try {
                $verification = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => $turnstileSecret,
                    'response' => $turnstileResponse,
                    'remoteip' => $request->ip(),
                ]);

                if (!$verification->json('success')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Bot challenge verification failed. Please try submitting again.',
                    ], 422);
                }
            } catch (\Exception $e) {
                Log::error('Cloudflare Turnstile verification error: ' . $e->getMessage());
                // In case of upstream timeout, continue to allow legitimate lead
            }
        }

        // 3. Persist inquiry to database
        $inquiry = Inquiry::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'service_type' => $validated['service_type'] ?? null,
            'budget_range' => $validated['budget_range'] ?? null,
            'message' => trim($validated['message']),
            'ip_address' => $request->ip(),
            'status' => Inquiry::STATUS_NEW,
        ]);

        // 4. Dispatch queued notification email to admin-configured contact email
        $siteSettings = \App\Models\SiteSetting::current();
        $recipient = $siteSettings->contact_email ?: env('AGENCY_CONTACT_EMAIL', config('mail.from.address'));
        try {
            Mail::to($recipient)->queue(new InquiryReceivedMail($inquiry));
        } catch (\Exception $e) {
            Log::error('Failed to queue inquiry notification email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => "Thank you, {$inquiry->name}! Your project inquiry has been received. We will get back to you within 24 hours.",
            'inquiry_id' => $inquiry->id,
        ], 201);
    }
}
