<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = \Faker\Factory::create('pt_BR');
        // for ($i = 1; $i < 150012; $i++) {
        //     DB::table('clients')->insert([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'cpf' => str_replace('-', '', str_replace('.', '', $faker->unique()->cpf)),
        //         'address' => $faker->address,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
