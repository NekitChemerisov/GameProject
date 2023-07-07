<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Genre;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    Game::create([
        'name' => 'WoW',
        'description'=> 'good game'
    ]);

    Game::create([
        'name' => 'CS:GO',
        'description'=> 'bad game'
    ]);

    Genre::create([
        'name' => 'Боевик',
        'game_id' => '1'
    ]);

    Genre::create([
        'name' => 'РПГ',
        'game_id' => '2'
    ]);
    
}
}
