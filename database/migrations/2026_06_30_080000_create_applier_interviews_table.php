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
        Schema::create('applier_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->onDelete('cascade');
            
            // Keadaan Fisik
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('riwayat_penyakit')->nullable();
            $table->string('kacamata')->nullable(); // YA/TIDAK
            $table->string('hobi')->nullable();
            $table->string('olahraga')->nullable();

            // 10 Faktor Penilaian
            $table->integer('f_penampilan')->nullable();
            $table->integer('f_kematangan_emosi')->nullable();
            $table->integer('f_kemampuan_mengungkap_pikiran')->nullable();
            $table->integer('f_motivasi_inisiatif')->nullable();
            $table->integer('f_keterampilan_pemecahan_masalah')->nullable();
            $table->integer('f_kemampuan_komunikasi_persuasi')->nullable();
            $table->integer('f_rasa_percaya_diri')->nullable();
            $table->integer('f_kesesuaian_persyaratan')->nullable();
            $table->integer('f_pengetahuan_bidang')->nullable();
            $table->integer('f_kemampuan_kerjasama')->nullable();

            $table->double('rata_rata')->nullable();
            $table->string('rekomendasi')->nullable(); // MEMENUHI SYARAT / PERTIMBANGAN / TIDAK DISARANKAN

            // Tahap 1 (Wawancara User)
            $table->string('interviewer_name_1')->nullable();
            $table->date('interview_date_1')->nullable();
            
            // Tahap 2 (Wawancara Direktur)
            $table->string('interviewer_name_2')->nullable();
            $table->date('interview_date_2')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applier_interviews');
    }
};
