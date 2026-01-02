<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplierSubtables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applier_scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->onDelete('cascade');
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('applier_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->onDelete('cascade');
            $table->string('type')->nullable(); // STR or SIP
            $table->string('section')->nullable(); // Bagian
            $table->string('number')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('issuer')->nullable(); // Institusi Penerbit
            $table->string('facility')->nullable(); // Nama Fasilitas Pelayanan Kesehatan
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('applier_others', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->onDelete('cascade');
            $table->string('document_type')->nullable(); // Jenis Dokumen
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('applier_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->onDelete('cascade');
            $table->string('level')->nullable(); // Tingkat Pendidikan
            $table->string('institution')->nullable(); // Nama Institusi
            $table->text('address')->nullable(); // Alamat Institusi
            $table->string('major')->nullable(); // Jurusan
            $table->string('other_major')->nullable(); // Jurusan Lainnya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applier_educations');
        Schema::dropIfExists('applier_others');
        Schema::dropIfExists('applier_licenses');
        Schema::dropIfExists('applier_scholarships');
    }
}
