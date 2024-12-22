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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subdomain')->unique();
            $table->string('db_name')->unique();
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $table->date('trial_start_date')->nullable();
            $table->date('trial_end_date')->nullable();
            $table->enum('status', ['trial', 'active', 'expired'])->default('trial');
            $table->date('next_billing_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
