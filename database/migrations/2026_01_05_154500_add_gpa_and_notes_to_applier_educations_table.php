<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGpaAndNotesToApplierEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applier_educations', function (Blueprint $table) {
            $table->string('gpa')->nullable()->after('other_major'); // IPK / Nilai Akhir
            $table->text('additional_notes')->nullable()->after('gpa'); // Pendidikan Tambahan (Bila Ada)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applier_educations', function (Blueprint $table) {
            $table->dropColumn(['gpa', 'additional_notes']);
        });
    }
}
