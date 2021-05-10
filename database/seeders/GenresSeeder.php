<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')
            ->insert([
                ['name' => 'Fantasy'],
                ['name' => 'SF'],
                ['name' => 'Kryminał'],
                ['name' => 'Thriller'],
                ['name' => 'Romans'],
                ['name' => 'Historyczne'],
                ['name' => 'Biografia'],
                ['name' => 'Naukowe'],
                ['name' => 'Komiks'],
                ['name' => 'Prasa']
            ]);
    }
}
