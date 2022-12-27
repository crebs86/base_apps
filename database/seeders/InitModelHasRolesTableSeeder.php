<?php

namespace Database\Seeders\cs\laravel9_base\base_apps\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('model_has_roles')->delete();

        DB::table('model_has_roles')->insert(array(
            0 =>
            array(
                'model_id' => 1,
                'model_type' => 'App\\Models\\User',
                'role_id' => 1,
            ),
        ));
    }
}
