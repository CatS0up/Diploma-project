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
        // Initial privilaged users
        User::factory()
            ->count(2)
            ->hasAddress()
            ->hasPersonalDetails()
            ->create(
                [
                    'role_id' => '3',
                    'uid' => 'jdoe77',
                    'pwd' => self::INITIAL_PWD
                ]
            );

        // Rest users
        User::factory()
            ->count(1000)
            ->hasAddress()
            ->hasPersonalDetails()
            ->create();
    }
}
