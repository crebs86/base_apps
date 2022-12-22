<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>

    <Head title="Página Expirada" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Erro ao Processar Solicitação
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-6 px-1 bg-teal-500 rounded border border-teal-500">
                        <div>
                            <div class="container mx-auto">
                                <div class="mx-auto text-center bg-transparent dark:text-gray-700">
                                    A página acessada expirou por inatividade. Volte atavés do botão abaixo, verifique
                                    seu formulário e tente novamente.
                                </div>
                            </div>
                        </div>
                    </div>
                    <Link :href="$page.props.url" class="flex justify-center">
                    <button type="button"
                        class="border border-teal-500 bg-teal-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline">
                        Voltar ao formulário.
                    </button>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
