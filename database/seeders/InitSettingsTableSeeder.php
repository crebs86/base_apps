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

        DB::table('settings')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'general',
                'settings' => '{"canRegister":["Registro: permitir registro de usuário sem a necessidade de estar logado.",false],"mustVerifyEmail":["Validação de e-mail: todo usuário registrado deverá verificar seu e-mail antes de poder utilizar o sistema.",true],"logoutAfterChangeEmail":["Alteração de e-mail: se usuário alterar seu endereço de e-mail, deverá fazer uma nova verificação antes de prosseguir com uso do sistema.",true],"requireCpf":["Exigir CPF no cadastro?",true],"saveUpdates":{"title":"Auditoria: quais dados devem ser salvos após alterados, para eventual auditoria?","branches":["Unidades",true],"clients":["Clientes",true],"permissions":["Permissões",true],"roles":["Papéis",true],"userRolesPermissions":["Controle de Acesso",true],"users":["Usuários",true]}}',
                'updated_at' => now(),
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'styles',
                'settings' => '{"main":{"body":"text-black dark:text-white bg-white dark:bg-gray-700","footer":"text-zinc-700 dark:text-gray-300 bg-orange-100 dark:bg-gray-700","footerLinks":"text-yellow-900 dark:text-green-500 hover:text-green-300 dark:hover:text-emerald-600"},"mainMenu":{"header":"text-black dark:text-white bg-white dark:bg-gray-700","body":"text-gray-700 dark:text-white bg-white dark:bg-gray-700","icons":"text-yellow-700 dark:text-green-600 hover:text-white dark:hover:text-red-700"},"aclMenu":{"body":"text-gray-700 dark:text-white bg-white dark:bg-gray-700","icons":"text-yellow-700 dark:text-green-600 hover:text-white dark:hover:text-red-700"}}',
                'updated_at' => now(),
            ),
        ));
    }
}
