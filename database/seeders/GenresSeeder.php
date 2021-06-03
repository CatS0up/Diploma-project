<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    private const INITIAL_GENRES = [
        'Fantasy', 'SF', 'Kryminał', 'Thriller',
        'Romans', 'Historyczne', 'Biograficzne',
        'Naukowe', 'Komis', 'Prasa'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::INITIAL_GENRES as $genre)
            Genre::factory()
                ->create([
                    'name' => $genre,
                    'slug' => $genre
                ]);
    }
}
