<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">
                Painel
            </h2>
        </template>
        <SubSection>
            <template #content>
                <div class="p-6 border-b border-gray-900">
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
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>
