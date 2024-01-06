<?php

namespace Database\Seeders;

use App\Models\Identity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Identity::create([
            'name' => "Rumah Sakit Livasya",
            'visi' => "Test",
            'misi' => "Test",
            'tujuan' => "Test",
            'sejarah' => "Test",
            'facebook' => "Test",
            'instagram' => "Test",
            'twitter' => "Test",
            'youtube' => "Test",
            'no_hp' => "Test",
            'no_telp' => "Test",
            'email' => "Test",
            'alamat' => "Test",
            'jml_pasien_puas' => 1000,
            'jml_fasilitas_kamar' => 100
        ]);
    }
}
