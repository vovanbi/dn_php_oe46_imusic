<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(15)->create();
        \App\Models\Category::factory()->count(12)->create();
        \App\Models\Artist::factory()->count(15)->create();
        \App\Models\Album::factory()->count(15)->create(); 
        \App\Models\Song::factory()->count(30)->create();     
    }
}
