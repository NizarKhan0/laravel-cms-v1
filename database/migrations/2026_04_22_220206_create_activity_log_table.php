<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->nullable()->index();
            $table->text('description');
            $table->nullableMorphs('subject', 'subject');
            $table->string('event')->nullable();
            $table->nullableMorphs('causer', 'causer');
            $table->json('attribute_changes')->nullable();
            $table->json('properties')->nullable();

            // New columns for tracking
            $table->string('url')->nullable();
            $table->string('ip_address', 45)->nullable(); // IPv6 support (max 45 chars)
            $table->text('user_agent')->nullable();

            $table->timestamps();

            // Optional: Add indexes for better performance
            $table->index('ip_address');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
