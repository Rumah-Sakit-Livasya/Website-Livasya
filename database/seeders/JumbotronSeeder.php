<?php

namespace Database\Seeders;

use App\Models\Jumbotron;
use Illuminate\Database\Seeder;

class JumbotronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jumbotron::create([
            'title' => 'Stay Safe, Stay Healty',
            'title_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus omnis reprehenderit repudiandae praesentium minima optio vitae blanditiis nemo quae, amet vero obcaecati reiciendis accusamus assumenda, doloremque, atque officiis beatae deserunt!',
            'main_image' => 'jumbotron-img/vkqCEJ9b8i4GWuaBSkY61jLDoTc4cd0h0M7LOCFY.svg'
        ]);
    }
}
