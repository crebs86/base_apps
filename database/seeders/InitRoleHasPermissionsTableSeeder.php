<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitRoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('role_has_permissions')->delete();
        
        DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 10,
                'role_id' => 2,
            ),
            3 => 
            array (
                'permission_id' => 12,
                'role_id' => 2,
            ),
            4 => 
            array (
                'permission_id' => 17,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 18,
                'role_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 19,
                'role_id' => 2,
            ),
            7 => 
            array (
                'permission_id' => 12,
                'role_id' => 3,
            ),
            8 => 
            array (
                'permission_id' => 19,
                'role_id' => 3,
            ),
            9 => 
            array (
                'permission_id' => 13,
                'role_id' => 4,
            ),
            10 => 
            array (
                'permission_id' => 14,
                'role_id' => 4,
            ),
            11 => 
            array (
                'permission_id' => 15,
                'role_id' => 4,
            ),
            12 => 
            array (
                'permission_id' => 16,
                'role_id' => 4,
            ),
            13 => 
            array (
                'permission_id' => 1,
                'role_id' => 5,
            ),
            14 => 
            array (
                'permission_id' => 4,
                'role_id' => 5,
            ),
            15 => 
            array (
                'permission_id' => 10,
                'role_id' => 5,
            ),
            16 => 
            array (
                'permission_id' => 3,
                'role_id' => 6,
            ),
            17 => 
            array (
                'permission_id' => 6,
                'role_id' => 6,
            ),
            18 => 
            array (
                'permission_id' => 12,
                'role_id' => 6,
            ),
            19 => 
            array (
                'permission_id' => 19,
                'role_id' => 7,
            ),
            20 => 
            array (
                'permission_id' => 20,
                'role_id' => 7,
            ),
            21 => 
            array (
                'permission_id' => 21,
                'role_id' => 7,
            ),
            22 => 
            array (
                'permission_id' => 22,
                'role_id' => 7,
            ),
        ));
        
        
    }
}