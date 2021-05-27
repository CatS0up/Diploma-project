<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    private const INITIAL_ROLES = ['user', 'admin', 'superadmin'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
            ->insert(array_map(fn ($name) => [
                'name' => $name
            ], self::INITIAL_ROLES));
    }
}
