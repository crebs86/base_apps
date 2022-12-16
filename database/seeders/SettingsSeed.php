<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name' => 'general',
                'settings' => json_encode([
                    'canRegister' => ['Permitir registro de noso usuário sem a necessidade de estar logado.', false],
                    'mustVerifyEmail' => ['Todo usuário registrado deverá verificar seu e-mail antes de poder utilizar o sistema.', true],
                    'logoutAfterChangeEmail' => ['Se usuário alterar seu endereço de e-mail, deverá fazer uma nova verificação antes de proseguir com uso do sistema.', true],
                    'saveUpdates' => [
                        'Quais dados devem ser salvos, após alterados, para eventual auditoria?',
                        'branches' => true,
                        'clientes' => true,
                        'permissions' => true,
                        'settings' => true,
                        'users' => true,
                    ]

                ]),
                'updated_at' => now()
            ]
        ]);
    }
}
