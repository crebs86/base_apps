<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const tab = ref(1);
const currentTab = (tabNumber) => (tab.value = tabNumber);

</script>

<template>

    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl dark:text-gray-300 leading-tight">
                Controle de Acesso - Início
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg dark:bg-gray-800 dark:shadow-gray-600">
                    <div class="py-6 px-1 bg-white border-b border-gray-200 dark:bg-gray-600 dark:border dark:border-gray-600">
                        <!-- ACL Tabs Start -->
                        <div>
                            <div class="container mx-auto">
                                <ul class="flex justify-center space-x-2 text-white dark:text-gray-300">
                                    <li>
                                        <button @click="currentTab(1)"
                                            class="inline-block px-4 py-2 bg-blue-500 focus:outline-none">
                                            ACL
                                        </button>
                                    </li>
                                    <li>
                                        <Link :href="route('admin.acl.users.index')">
                                        <button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none">
                                            Usuários
                                        </button>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link :href="route('admin.acl.roles.index')">
                                        <button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none">
                                            Papéis
                                        </button>
                                        </Link>
                                    </li>
                                    <li>
                                        <button @click="currentTab(3)"
                                            class="inline-block px-4 py-2 bg-blue-500 focus:outline-none">
                                            Permissões
                                        </button>
                                    </li>
                                </ul>
                                <div class="py-3 px-2 mt-6 text-justify bg-white dark:bg-gray-600">
                                    <div v-if="tab === 1">
                                        <p class="mb-2"><strong>Usuários</strong>: Busque por usuários do sistema.
                                            Ative, desative, atribua e remova papéis atribuídos.</p>
                                        <p class="mb-2"><strong>Papéis</strong>: Lista de papéis a serem atruídos a
                                            usuários do sistema. Cada papel pode ter várias permissões atribuídas.</p>
                                        <p class="mb-2"><strong>Permissões</strong>: Lista de permissões a serem
                                            atruídas a papéis. Permissões definem cada ação do sistema. Ex.: Criar
                                            Paciente, Editar Paciente, Apagar Paciente, etc.</p>
                                    </div>
                                    <div v-if="tab === 2">
                                        <!-- <AclUsers /> -->
                                    </div>
                                    <div v-if="tab === 3">
                                        Permissões
                                    </div>
                                    <!-- <div v-if="tab === 4">
                                        
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- ACL Tabs End -->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
