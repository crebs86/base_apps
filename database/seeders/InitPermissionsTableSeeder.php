<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('permissions')->delete();
        
        DB::table('permissions')->insert(array (
            0 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'Usuario Criar',
                'updated_at' => now(),
            ),
            1 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'Admin Criar',
                'updated_at' => now(),
            ),
            2 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 3,
                'name' => 'Cliente Criar',
                'updated_at' => now(),
            ),
            3 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 4,
                'name' => 'Usuario Editar',
                'updated_at' => now(),
            ),
            4 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 5,
                'name' => 'Admin Editar',
                'updated_at' => now(),
            ),
            5 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 6,
                'name' => 'Cliente Editar',
                'updated_at' => now(),
            ),
            6 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 7,
                'name' => 'Usuario Apagar',
                'updated_at' => now(),
            ),
            7 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 8,
                'name' => 'Admin Apagar',
                'updated_at' => now(),
            ),
            8 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 9,
                'name' => 'Cliente Apagar',
                'updated_at' => now(),
            ),
            9 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 10,
                'name' => 'Usuario Ver',
                'updated_at' => now(),
            ),
            10 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 11,
                'name' => 'Admin Ver',
                'updated_at' => now(),
            ),
            11 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 12,
                'name' => 'Cliente Ver',
                'updated_at' => now(),
            ),
            12 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 13,
                'name' => 'ACL Criar',
                'updated_at' => now(),
            ),
            13 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 14,
                'name' => 'ACL Editar',
                'updated_at' => now(),
            ),
            14 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 15,
                'name' => 'ACL Apagar',
                'updated_at' => now(),
            ),
            15 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 16,
                'name' => 'ACL Ver',
                'updated_at' => now(),
            ),
            16 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 17,
                'name' => 'Relatorio Criar',
                'updated_at' => now(),
            ),
            17 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 18,
                'name' => 'Dados Lancar',
                'updated_at' => now(),
            ),
            18 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 19,
                'name' => 'Unidade Ver',
                'updated_at' => now(),
            ),
            19 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 20,
                'name' => 'Unidade Criar',
                'updated_at' => now(),
            ),
            20 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 21,
                'name' => 'Unidade Editar',
                'updated_at' => now(),
            ),
            21 => 
            array (
                'created_at' => now(),
                'guard_name' => 'web',
                'id' => 22,
                'name' => 'Unidade Apagar',
                'updated_at' => now(),
            ),
        ));
        
        
    }
}