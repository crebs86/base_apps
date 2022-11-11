<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import { Head } from '@inertiajs/inertia-vue3';

</script>

<template>

    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <div
            class="container mx-auto mt-1 text-justify px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <div>
                <p class="mb-2"><strong>Usuários</strong>: Busque por usuários do sistema.
                    Ative, desative, atribua e remova papéis atribuídos.</p>
                <p class="mb-2"><strong>Papéis</strong>: Lista de papéis a serem atruídos a
                    usuários do sistema. Cada papel pode ter várias permissões atribuídas.</p>
                <p class="mb-2"><strong>Permissões</strong>: Lista de permissões a serem
                    atruídas a papéis. Permissões definem cada ação do sistema. Ex.: Criar
                    Paciente, Editar Paciente, Apagar Paciente, etc.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
