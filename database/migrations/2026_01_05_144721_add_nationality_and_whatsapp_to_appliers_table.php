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
        Schema::table('appliers', function (Blueprint $table) {
            $table->string('nationality')->nullable()->after('religion');
            $table->string('whatsapp_number')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appliers', function (Blueprint $table) {
            $table->dropColumn(['nationality', 'whatsapp_number']);
        });
    }
};
