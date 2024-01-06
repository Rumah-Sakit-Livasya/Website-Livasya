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
        Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('visi');
            $table->text('misi');
            $table->text('tujuan');
            $table->string('sejarah');
            $table->text('facebook');
            $table->text('instagram');
            $table->text('twitter');
            $table->text('youtube');
            $table->string('no_hp');
            $table->string('no_telp');
            $table->string('email');
            $table->string('alamat');
            $table->integer('jml_pasien_puas');
            $table->integer('jml_fasilitas_kamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identities');
    }
};
