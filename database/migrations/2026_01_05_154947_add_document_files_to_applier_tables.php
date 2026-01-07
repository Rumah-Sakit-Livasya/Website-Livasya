<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentFilesToApplierTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appliers', function (Blueprint $table) {
            $table->string('cv')->nullable()->after('about_me'); // Upload CV
        });

        Schema::table('applier_educations', function (Blueprint $table) {
            $table->string('certificate')->nullable()->after('additional_notes'); // Ijazah
            $table->string('transcript')->nullable()->after('certificate'); // Transkrip
        });

        Schema::table('applier_licenses', function (Blueprint $table) {
            $table->string('file')->nullable()->after('description'); // Bukti STR/SIP
        });

        Schema::table('applier_certifications', function (Blueprint $table) {
            $table->string('file')->nullable()->after('description'); // Bukti Sertifikat
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appliers', function (Blueprint $table) {
            $table->dropColumn('cv');
        });

        Schema::table('applier_educations', function (Blueprint $table) {
            $table->dropColumn(['certificate', 'transcript']);
        });

        Schema::table('applier_licenses', function (Blueprint $table) {
            $table->dropColumn('file');
        });

        Schema::table('applier_certifications', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
}
