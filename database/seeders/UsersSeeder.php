<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    private const INITIAL_USERS_PWD = 'FooBar12345%';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            $faker = Factory::create('pl_PL');

            $users = [
                'superadmin' => [
                    'account_data' => [
                        'role_id' => 3,
                        'uid' => 'jdoe77',
                        'email' => $faker->email(),
                        'phone' => $faker->numberBetween(1000000, 99999999),
                        'pwd' => Hash::make(self::INITIAL_USERS_PWD),
                        'description' => $faker->text(255)
                    ],
                    'personal_details' => [
                        'user_id' => 1,
                        'firstname' => $faker->firstName('male'),
                        'lastname' => $faker->lastName('male'),
                        'birthday' => $faker->date('Y-m-d'),
                        'gender' => 'M'
                    ],
                    'address' => [
                        'user_id' => 1,
                        'town' => $faker->city(),
                        'zipcode' => $faker->postcode(),
                        'street' => $faker->streetName(),
                        'house_number' => $faker->buildingNumber()
                    ]
                ],

                'admin' => [
                    'account_data' => [
                        'role_id' => 2,
                        'uid' => 'janedoe13',
                        'email' => $faker->email(),
                        'phone' => $faker->numberBetween(1000000, 99999999),
                        'pwd' => Hash::make(self::INITIAL_USERS_PWD),
                        'description' => $faker->text(255)
                    ],
                    'personal_details' => [
                        'user_id' => 2,
                        'firstname' => $faker->firstName('female'),
                        'lastname' => $faker->lastName('female'),
                        'birthday' => $faker->date('Y-m-d'),
                        'gender' => 'K'
                    ],
                    'address' => [
                        'user_id' => 2,
                        'town' => $faker->city(),
                        'zipcode' => $faker->postcode(),
                        'street' => $faker->streetName(),
                        'house_number' => $faker->buildingNumber()
                    ]
                ],

                'user' => [
                    'account_data' => [
                        'role_id' => 1,
                        'uid' => 'dummyuser',
                        'email' => $faker->email(),
                        'phone' => $faker->numberBetween(1000000, 99999999),
                        'pwd' => Hash::make(self::INITIAL_USERS_PWD),
                        'description' => $faker->text(255)
                    ],
                    'personal_details' => [
                        'user_id' => 3,
                        'firstname' => $faker->firstName('male'),
                        'lastname' => $faker->lastName('male'),
                        'birthday' => $faker->date('Y-m-d'),
                        'gender' => 'M'
                    ],
                    'address' => [
                        'user_id' => 3,
                        'town' => $faker->city(),
                        'zipcode' => $faker->postcode(),
                        'street' => $faker->streetName(),
                        'house_number' => $faker->buildingNumber()
                    ]
                ]
            ];


            DB::table('users')->insert(
                $users['superadmin']['account_data'],
                $users['admin']['account_data'],
                $users['user']['account_data']
            );

            DB::table('personal_details')->insert(
                $users['superadmin']['personal_details'],
                $users['admin']['personal_details'],
                $users['user']['personal_details']
            );

            DB::table('addresses')->insert(
                $users['superadmin']['address'],
                $users['admin']['address'],
                $users['user']['address']
            );
        });
    }
}
