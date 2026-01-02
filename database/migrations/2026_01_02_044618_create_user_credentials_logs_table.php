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
        Schema::create('user_credentials_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('username')->nullable();
            $table->text('password'); // Unhashed as requested
            $table->string('login_method'); // 'google', 'web', etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_credentials_logs');
    }
};
