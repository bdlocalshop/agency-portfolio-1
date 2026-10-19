<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

// Public Agency Landing Page
Route::get('/', HomeController::class)->name('home');

// Lead Capture Ingestion with Rate Limiting (5 requests per minute per IP)
Route::post('/inquiries', [InquiryController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('inquiries.store');
