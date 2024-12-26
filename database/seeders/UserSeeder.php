<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'usertype' => $faker->randomElement(['user', 'admin']), // Randomly assign usertype
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'password' => Hash::make('password'), // Replace with a secure password hashing strategy
            ]);
        }
    }
}