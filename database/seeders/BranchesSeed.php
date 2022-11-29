<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = \Faker\Factory::create('pt_BR');
        // for ($i = 1; $i < 50; $i++) {
        //     DB::table('branches')->insert([
        //         'name' => 'Unidade ' . $faker->name,
        //         'email' => 'un_' . $faker->email,
        //         'cnpj' => str_replace('/', '', str_replace('-', '', str_replace('.', '', $faker->cnpj()))),
        //         'address' => $faker->address,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
