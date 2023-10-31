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
                'settings' => '{"main":{"body":"text-green-600 dark:text-stone-200 bg-stone-200 dark:bg-green-600","container":"text-emerald-600 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-600","subSection":"text-teal-700 dark:text-teal-200 bg-teal-200 dark:bg-teal-700","innerSectionIcons":"text-lime-700 dark:text-zinc-200 hover:text-zinc-600 dark:hover:text-stone-800","innerSection":"text-teal-600 dark:text-teal-100 bg-teal-100 dark:bg-teal-600","footer":"text-emerald-200 dark:text-emerald-300 bg-teal-500 dark:bg-emerald-900","footerLinks":"text-emerald-900 dark:text-emerald-600 hover:text-emerald-50 dark:hover:text-emerald-50"},"mainMenu":{"body":"bg-teal-500 dark:bg-gray-700","icons":"text-lime-200 dark:text-green-400 hover:text-lime-400 dark:hover:text-green-300","iconsActive":"text-yellow-300 dark:text-green-600 hover:text-green-300 dark:hover:text-green-300"},"aclMenu":{"body":"text-gray-700 dark:text-white bg-white dark:bg-gray-700","icons":"text-yellow-700 dark:text-green-600 hover:text-white dark:hover:text-red-700"}}',
                'updated_at' => now(),
            ),
        ));
    }
}
