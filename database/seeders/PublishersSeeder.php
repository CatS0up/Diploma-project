<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublishersSeeder extends Seeder
{
    private const INITIAL_PUBLISHERS = [
        'Pearson', 'Reed Elsevier', 'Wolters Kluwer',
        'Random House', 'Hachette Livre', 'Grupo Planeta',
        'McGraw-Hill Education', 'Holtzbrinck', 'Scholastic'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publishers')
            ->insert(
                array_map(fn ($name) => [
                    'name' => $name,
                    'slug' => $name
                ], self::INITIAL_PUBLISHERS)
            );
    }
}
