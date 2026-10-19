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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 255)->index();
            $table->string('service_type', 100)->nullable();
            $table->string('budget_range', 50)->nullable();
            $table->text('message');
            $table->string('ip_address', 45)->nullable();
            $table->enum('status', ['new', 'contacted', 'closed'])->default('new')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
