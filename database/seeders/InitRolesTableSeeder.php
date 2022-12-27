<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('roles')->delete();

        DB::table('roles')->insert(array(
            0 =>
            array(
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'Super Admin',
                'updated_at' => now(),
            ),
            1 =>
            array(
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'Admin',
                'updated_at' => now(),
            ),
            2 =>
            array(
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 3,
                'name' => 'Viewer',
                'updated_at' => now(),
            ),
            3 =>
            array(
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 4,
                'name' => 'ACL Administrar',
                'updated_at' => now(),
            ),
            4 =>
            array(
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 5,
                'name' => 'Usuario Administrar',
                'updated_at' => now(),
            ),
            5 =>
            array(
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 6,
                'name' => 'Cliente Administrar',
                'updated_at' => now(),
            ),
            6 =>
            array(
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 7,
                'name' => 'Unidade Administrar',
                'updated_at' => now(),
            ),
        ));
    }
}
