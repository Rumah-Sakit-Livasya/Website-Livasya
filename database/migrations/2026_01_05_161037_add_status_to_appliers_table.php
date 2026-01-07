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
            $table->string('status')->default('processed')->after('career_id')->comment('processed, accepted, rejected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appliers', function (Blueprint $table) {
            //
        });
    }
};
