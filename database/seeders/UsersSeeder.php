<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pl_PL');

        $id = DB::table('users')->insertGetId(
            [
                'role_id' => 3,
                'uid' => 'john123',
                'email' => 'superadmin@example.com',
                'phone' => $faker->numberBetween(100000000, 999999999),
                'pwd' => Hash::make('FooBar12345%'),
                'description' => $faker->text(255)
            ]
        );

        DB::table('personal_details')->insert(
            [
                'user_id' => $id,
                'firstname' => $faker->firstName('male'),
                'lastname' => $faker->lastName('male'),
                'birthday' => $faker->date(),
                'gender' => 'm'
            ]
        );

        DB::table('addresses')->insert(
            [
                'user_id' => $id,
                'town' => $faker->city(),
                'zipcode' => $faker->postcode(),
                'street' => $faker->streetName(),
                'house_number' => $faker->buildingNumber()
            ]
        );

        $id = DB::table('users')->insertGetId(
            [
                'role_id' => 2,
                'uid' => 'janedoe',
                'email' => 'admin@example.com',
                'phone' => $faker->numberBetween(100000000, 999999999),
                'pwd' => Hash::make('FooBar12345%'),
                'description' => $faker->text(255)
            ]
        );

        DB::table('personal_details')->insert(
            [
                'user_id' => $id,
                'firstname' => $faker->firstName('female'),
                'lastname' => $faker->lastName('female'),
                'birthday' => $faker->date(),
                'gender' => 'k'
            ]
        );

        DB::table('addresses')->insert(
            [
                'user_id' => $id,
                'town' => $faker->city(),
                'zipcode' => $faker->postcode(),
                'street' => $faker->streetName(),
                'house_number' => $faker->buildingNumber()
            ]
        );
    }
}
