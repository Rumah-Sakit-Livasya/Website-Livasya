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
            $table->string('position_interest')->nullable();
            $table->unsignedBigInteger('career_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appliers', function (Blueprint $table) {
            $table->dropColumn('position_interest');
            $table->unsignedBigInteger('career_id')->nullable(false)->change();
        });
    }
};
