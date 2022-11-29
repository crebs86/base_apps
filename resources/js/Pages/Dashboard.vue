<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>

    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">
                Painel
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-600 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-900 dark:bg-gray-600">
                        Dados do Usuário
                    </div>
                    <div class="p-6">
                        <p>Bem-vindo(a), {{ $page.props.auth.user.name }}!</p>
                        <p>Seguimos com alguns dados da sua conta:</p>
                        <p class="pt-4">
                            <span class="font-bold">Nome:</span> {{ $page.props.auth.user.name }}
                        </p>
                        <p class="pt-2">
                            <span class="font-bold">E-mail:</span> {{ $page.props.auth.user.email }}
                        </p>
                        <p class="pt-2">Papéis no sistema:</p>
                        <p class="pl-3">
                        <ul>
                            <li v-for="v in $page.props.auth.roles" :key="v"> - {{ v }}</li>
                        </ul>
                        </p>
                        <p class="pt-2">Permissões no sistema:</p>
                        <p class="pl-3">
                        <ul>
                            <li v-for="v in $page.props.auth.permissions" :key="v"> - {{ v }}</li>
                        </ul>
                        </p>
                    </div>
                    <div class="p-6">
                        <p>Novidades:</p>
                        <p class="pl-3">Versão {{ $page.props.app.version }}, lançada em {{ $page.props.app.released }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
