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
                'settings' => '{
                    "canRegister":
                        ["Registro: permitir registro de usuário sem a necessidade de estar logado.",false],
                    "mustVerifyEmail":
                        ["Validação de e-mail: todo usuário registrado deverá verificar seu e-mail antes de poder utilizar o sistema.",true],
                    "logoutAfterChangeEmail":
                        ["Alteração de e-mail: se usuário alterar seu endereço de e-mail, deverá fazer uma nova verificação antes de prosseguir com uso do sistema.",true],
                    "requireCpf":
                        ["Exigir CPF no cadastro?",true],"saveUpdates":{"title":"Auditoria: quais dados devem ser salvos após alterados, para eventual auditoria?",
                    "branches":
                        ["Unidades",true],"clients":["Clientes",true],"permissions":["Permissões",true],"roles":["Papéis",true],
                    "userRolesPermissions":
                        ["Controle de Acesso",true],
                    "users":
                        ["Usuários",true]}}',
                'updated_at' => now(),
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'styles',
                'settings' => '
                
                    {
                        "main":
                            {
                                "body":"text-green-800 dark:text-gray-300 bg-teal-200 dark:bg-gray-700",
                                "container":"text-green-800 dark:text-gray-300 bg-teal-300 dark:bg-gray-800",
                                "subSection":"text-green-800 dark:text-gray-200 bg-teal-200 dark:bg-gray-700",
                                "innerSectionIcons":"text-amber-500 dark:text-yellow-100 hover:text-amber-700 dark:hover:text-yellow-200",
                                "innerSection":"text-teal-600 dark:text-gray-300 bg-teal-200 dark:bg-gray-700",
                                "formsStyles":"text-green-800 dark:text-slate-700 bg-teal-300 dark:bg-gray-400",
                                "footer":"text-slate-600 dark:text-slate-200 bg-teal-400 dark:bg-gray-900",
                                "footerLinks":"text-amber-500 dark:text-yellow-400 hover:text-amber-700 dark:hover:text-white"
                            },
                        "mainMenu":
                        {
                            "body":"bg-teal-400 dark:bg-gray-900",
                            "icons":"text-teal-100 dark:text-slate-200 hover:text-teal-600 dark:hover:text-slate-600",
                            "iconsActive":"text-amber-500 dark:text-yellow-300 hover:text-amber-700 dark:hover:text-yellow-500"
                        },
                        "aclMenu":
                            {
                                "body":"text-gray-700 dark:text-white bg-white dark:bg-gray-700",
                                "icons":"text-yellow-700 dark:text-green-600 hover:text-white dark:hover:text-red-700"
                            }
                    }',
                'updated_at' => now(),
            ),
        ));
    }
}
