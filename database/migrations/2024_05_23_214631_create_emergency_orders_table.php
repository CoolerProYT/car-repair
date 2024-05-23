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
        Schema::create('emergency_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('emergency_id')->constrained('emergencies');
            $table->string('order_id')->unique();
            $table->string('tran_id')->nullable();
            $table->string('location');
            $table->string('latitude');
            $table->string('longitude');
            $table->double('total_payment');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_orders');
    }
};
