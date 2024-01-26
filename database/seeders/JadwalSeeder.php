<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create([
            'thumbnail' => 'thumbnail-img/vkqCEJ9b8i4GWuaBSkY61jLDoTc4cd0h0M7LOCFY.svg',
            'image' => 'image-img/vkqCEJ9b8i4GWuaBSkY61jLDoTc4cd0h0M7LOCFY.svg',
            'caption' => 'Stay Safe, Stay Healty',
        ]);
    }
}
