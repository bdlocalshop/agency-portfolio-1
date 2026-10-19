<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'service_type' => ['nullable', 'string', 'max:100'],
            'budget_range' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            'website_url_trap' => ['nullable', 'max:0'],
            'cf-turnstile-response' => ['nullable', 'string'],
        ];
    }

    /**
     * Custom error messages for form validation.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please provide your full name or company name.',
            'email.required' => 'A valid work email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please tell us briefly about your project goals.',
            'message.min' => 'Please provide a bit more context (at least 10 characters).',
            'website_url_trap.max' => 'Spam bot submission rejected.',
        ];
    }
}
