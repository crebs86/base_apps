<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 =>
            array(
                'branch_id' => NULL,
                'cpf' => '11736707779',
                'created_at' => now(),
                'deleted_at' => NULL,
                'email' => 'super_admin@crebs.dev',
                'email_verified_at' => now(),
                'id' => 1,
                'name' => 'Super Admin',
                'notes' => 'Default User',
                'password' => '$2y$10$s2Hogvn1G3ZC/3SGG9we/exaibaCHDjZPIfNODSpjDVZLdv99sMBy', //12345678
                'remember_token' => NULL,
                'updated_at' => now(),
            ),
        ));
    }
}
