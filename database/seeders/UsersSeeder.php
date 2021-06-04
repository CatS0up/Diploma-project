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
        /* Initial users */

        // Superadmin
        User::factory()
            ->hasPersonalDetails()
            ->create([
                'role_id' => 3,
                'uid' => 'johndoe77',
                'pwd' => self::INITIAL_PWD
            ]);

        // Admin
        User::factory()
            ->hasPersonalDetails()
            ->create([
                'role_id' => 2,
                'uid' => 'jdoe21',
                'pwd' => self::INITIAL_PWD
            ]);

        // User
        User::factory()
            ->hasPersonalDetails()
            ->create([
                'role_id' => 1,
                'uid' => 'dummyuser',
                'pwd' => self::INITIAL_PWD
            ]);


        /* Other users */
        User::factory()
            ->count(1754)
            ->hasPersonalDetails()
            ->create();
    }
}
