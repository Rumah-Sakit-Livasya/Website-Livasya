<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name" => "Rumah Sakit",
                "slug" => "rumah-sakit"
            ],
            [
                "name" => "Penghargaan",
                "slug" => "penghargaan"
            ],
            [
                "name" => "Lain Lain",
                "slug" => "lain-lain"
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
