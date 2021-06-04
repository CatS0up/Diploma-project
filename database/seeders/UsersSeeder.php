<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    private const INITIAL_PWD = 'FooBar12345%';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(1234)
            ->hasPersonalDetails()
            ->create();
    }
}
