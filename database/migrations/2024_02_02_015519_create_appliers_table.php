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
        Schema::create('appliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained('careers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('find_vacancy');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birth_place');
            $table->string('birth_day');
            $table->string('email');
            $table->string('sex');
            $table->string('marital_status');
            $table->string('religion');
            $table->string('id_card');
            $table->string('suku');
            $table->string('npwp');
            $table->string('social_security');
            $table->text('ktp_address');
            $table->text('permanent_address');
            $table->string('family_name');
            $table->string('family_sex');
            $table->string('family_relationship');
            $table->string('family_occupation');
            $table->string('family_contact');
            $table->string('emergency_name');
            $table->string('emergency_relation');
            $table->string('emergency_phone');
            $table->text('emergency_address');
            $table->string('school_name');
            $table->string('school_city');
            $table->string('school_major');
            $table->string('school_year');
            $table->string('school_qual');
            $table->string('school_gpa');
            $table->string('compensation_salary');
            $table->string('compensation_benefit');
            $table->string('compensation_workdate');
            $table->text('declare_family_member');
            $table->text('declare_suspended');
            $table->text('declare_criminal');
            $table->text('declare_lvs');
            $table->text('declare_lvs_when');
            $table->text('declare_lvs_where');
            $table->text('declare_lvs_position');
            $table->text('declare_lvs_stage');
            $table->text('declare_politic');
            $table->text('declare_government');
            $table->text('declare_business');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appliers');
    }
};
