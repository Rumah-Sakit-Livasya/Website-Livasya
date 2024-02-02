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
        Schema::create('applier_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('certification_name')->nullable();
            $table->string('certification_institution')->nullable();
            $table->string('certification_obtained')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applier_certifications');
    }
};
