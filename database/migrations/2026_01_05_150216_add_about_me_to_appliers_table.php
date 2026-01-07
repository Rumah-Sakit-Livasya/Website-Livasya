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
            $table->text('about_me')->nullable()->after('position_interest');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appliers', function (Blueprint $table) {
            $table->dropColumn('about_me');
        });
    }
};
