<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SubNavMenu from '@/Components/Admin/SubNavMenu.vue';
import { Head } from '@inertiajs/inertia-vue3';

</script>

<template>

    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl dark:text-gray-300 leading-tight">
                Controle de Acesso - Início
            </h2>
        </template>

        <div class="py-1 mx-1 dark:bg-gray-800">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg dark:bg-gray-800 dark:shadow-gray-600">
                    <SubNavMenu />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
