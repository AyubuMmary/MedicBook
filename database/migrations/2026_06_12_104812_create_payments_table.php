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
        Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('appointment_id', 100)->unique();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 8, 2);
        $table->string('stripe_payment_id')->nullable();
        $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
