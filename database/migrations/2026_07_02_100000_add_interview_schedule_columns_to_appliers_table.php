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
            $table->date('interview_date')->nullable()->after('attachment');
            $table->string('interview_time')->nullable()->after('interview_date');
            $table->string('interview_type')->nullable()->after('interview_time'); // online, offline
            $table->string('interview_location')->nullable()->after('interview_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appliers', function (Blueprint $table) {
            $table->dropColumn(['interview_date', 'interview_time', 'interview_type', 'interview_location']);
        });
    }
};
