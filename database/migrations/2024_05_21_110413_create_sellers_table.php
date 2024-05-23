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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('store_name');
            $table->string('profile_image')->default('profile-image/defaultProfile.jpeg');
            $table->string('phone_number');
            $table->string('store_address');
            $table->string('store_latitude');
            $table->string('store_longitude');
            $table->string('verification_code')->nullable();
            $table->time('open_time');
            $table->time('close_time');
            $table->double('balance')->default(0);
            $table->string('state');
            $table->string('area');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
