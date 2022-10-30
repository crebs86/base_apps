<?php
return [
    /**
     * define se aplicação usará cache para papéis e permissões
     */
    'use_cache' => true,

    'cache_lifetime' => 60 * 60 * 4,

    /**
     * define permissões que não podem ser editadas/removidas do banco de dados
     */
    'protected_permissions' => [
        'Admin Apagar', 'Admin Criar', 'Admin Editar', 'Admin Ver',
        'Cliente Apagar', 'Cliente Criar', 'Cliente Editar', 'Cliente Ver',
        'Usuario Apagar', 'Usuario Criar', 'Usuario Editar', 'Usuario Ver'
    ],

    /**
     * define papéis que não podem ser editados/removidos do banco de dados
     */
    'protected_roles' => [
        'Super Admin', 'Admin'
    ],

    /**
     * define papéis que só podem ser editados por um Super Admin
     */
    'admin_roles' => [
        'Super Admin', 'Admin'
    ],

    /**
     * define permissões que só podem ser editados por um Super Admin
     */

    'admin_permissions' => [
        'Admin Apagar', 'Admin Criar', 'Admin Editar', 'Admin Ver'
    ],

    /**
     * define quem pode associar papéis de administradores a usuários
     */
    'admin_roles_edit' => [
        'Super Admin'
    ]
];
