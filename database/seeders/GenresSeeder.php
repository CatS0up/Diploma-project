<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
        DB::table('genres')
            ->insert(
                array_map(
                    fn ($name) =>  [
                        'name' => $name,
                        'slug' => Str::slug($name)
                    ],
                    self::INITIAL_GENRES
                )
            );
    }
}
