<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('settings')->delete();
        
        DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'general',
                'settings' => '{"canRegister":["Registro: permitir registro de usu\\u00e1rio sem a necessidade de estar logado.",false],"mustVerifyEmail":["Valida\\u00e7\\u00e3o de e-mail: todo usu\\u00e1rio registrado dever\\u00e1 verificar seu e-mail antes de poder utilizar o sistema.",true],"logoutAfterChangeEmail":["Altera\\u00e7\\u00e3o de e-mail: se usu\\u00e1rio alterar seu endere\\u00e7o de e-mail, dever\\u00e1 fazer uma nova verifica\\u00e7\\u00e3o antes de prosseguir com uso do sistema.",true],"saveUpdates":{"title":"Auditoria: quais dados devem ser salvos ap\\u00f3s alterados, para eventual auditoria?","branches":["Unidades",true],"clients":["Clientes",true],"permissions":["Permiss\\u00f5es",true],"roles":["Pap\\u00e9is",true],"userRolesPermissions":["Controle de Acesso",true],"users":["Usu\\u00e1rios",true]}}',
                'updated_at' => now(),
            ),
        ));
        
        
    }
}