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
        Schema::create('applier_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('work_name')->nullable();
            $table->string('work_position')->nullable();
            $table->string('work_address')->nullable();
            $table->string('work_start')->nullable();
            $table->string('work_end')->nullable();
            $table->string('work_start_salary')->nullable();
            $table->string('work_latest_salary')->nullable();
            $table->string('work_reason')->nullable();
            $table->string('work_contact_employer')->nullable();
            $table->string('work_contact_yes')->nullable();
            $table->string('work_achievement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applier_works');
    }
};
