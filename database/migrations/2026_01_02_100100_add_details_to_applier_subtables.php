<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToApplierSubtables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('applier_works', function (Blueprint $table) {
        //     $table->boolean('is_active')->default(false)->after('work_end'); // Masih Bekerja
        //     $table->text('description')->nullable()->after('work_achievement'); // Keterangan
        // });

        Schema::table('applier_certifications', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('certification_obtained');
            $table->date('end_date')->nullable()->after('start_date');
            $table->date('certificate_end_date')->nullable()->after('end_date');
            $table->text('description')->nullable()->after('certificate_end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applier_works', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'description']);
        });

        Schema::table('applier_certifications', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date', 'certificate_end_date', 'description']);
        });
    }
}
