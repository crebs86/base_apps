<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <SubSection>
            <template #header>
                Sobre o Recurso
            </template>
            <template #content>
                <p class="mb-2"><strong>Usuários</strong>: Busque por usuários do sistema.
                    Ative, desative, atribua e remova papéis já atribuídos.</p>
                <p class="mb-2"><strong>Papéis</strong>: Lista de papéis a serem atruídos a
                    usuários do sistema. Cada papel pode ter várias permissões atribuídas.</p>
                <p class="mb-2"><strong>Permissões</strong>: Lista de permissões a serem
                    atruídas a papéis. Permissões definem cada ação do sistema. Ex.: Criar
                    Cliente, Editar Cliente, Apagar Cliente, etc.</p>
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>
