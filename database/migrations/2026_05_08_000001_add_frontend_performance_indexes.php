<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->index(['is_active', 'departement_id'], 'doctors_active_department_idx');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->index('slug', 'posts_slug_idx');
            $table->index(['is_active', 'created_at'], 'posts_active_created_idx');
        });

        Schema::table('careers', function (Blueprint $table) {
            $table->index(['status', 'tipe', 'created_at'], 'careers_status_type_created_idx');
        });

        Schema::table('mitras', function (Blueprint $table) {
            $table->index(['is_primary', 'is_active'], 'mitras_primary_active_idx');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->index('is_active', 'faqs_active_idx');
        });

        Schema::table('pelayanans', function (Blueprint $table) {
            $table->index('slug', 'pelayanans_slug_idx');
        });

        Schema::table('image_pelayanans', function (Blueprint $table) {
            $table->index('pelayanan_id', 'image_pelayanans_pelayanan_idx');
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->index('unggulan', 'facilities_featured_idx');
        });

        Schema::table('departements', function (Blueprint $table) {
            $table->index('urutan', 'departements_order_idx');
        });
    }

    public function down(): void
    {
        Schema::table('departements', function (Blueprint $table) {
            $table->dropIndex('departements_order_idx');
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->dropIndex('facilities_featured_idx');
        });

        Schema::table('image_pelayanans', function (Blueprint $table) {
            $table->dropIndex('image_pelayanans_pelayanan_idx');
        });

        Schema::table('pelayanans', function (Blueprint $table) {
            $table->dropIndex('pelayanans_slug_idx');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex('faqs_active_idx');
        });

        Schema::table('mitras', function (Blueprint $table) {
            $table->dropIndex('mitras_primary_active_idx');
        });

        Schema::table('careers', function (Blueprint $table) {
            $table->dropIndex('careers_status_type_created_idx');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_active_created_idx');
            $table->dropIndex('posts_slug_idx');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropIndex('doctors_active_department_idx');
        });
    }
};
