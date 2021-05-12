<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublishersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publishers')
            ->insert([
                ['name' => 'Pearson'],
                ['name' => 'Reed Elsevier'],
                ['name' => 'Wolters Kluwer'],
                ['name' => 'Random House'],
                ['name' => 'Hachette Livre'],
                ['name' => 'Grupo Planeta'],
                ['name' => 'McGraw-Hill Education'],
                ['name' => 'Holtzbrinck'],
                ['name' => 'Scholastic ']
            ]);
    }
}
