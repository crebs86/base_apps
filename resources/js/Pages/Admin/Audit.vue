<script setup>

import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


</script>
<template>

    <Head title="Auditoria" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg font-bold text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded flex justify-center">
                Auditoria
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-1 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                            <div class="px-2 py-1 items-center justfy-center justify-around grid grid-cols-3">

                                <div class="flex flex-col items-center py-12 hover:text-emerald-400">
                                    <Link :href="route('audit.clients.index')"
                                        :active="route().current('audit.clients.index')"
                                        class="text-teal-600 hover:text-emerald-400 flex flex-col items-center max-w-fill">
                                    <mdicon name="account-heart" title="Auditar Clientes" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Clientes
                                    </span>
                                    </Link>
                                </div>
                                <div class="flex flex-col items-center py-12">
                                    <Link :href="route('audit.branches.index')"
                                        :active="route().current('audit.branches.index')"
                                        class="text-teal-600 hover:text-emerald-400 col-span-1 flex flex-col items-center max-w-max">
                                    <mdicon name="source-branch" title="Auditar Unidades" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Unidades
                                    </span>
                                    </Link>
                                </div>
                                <div class="flex flex-col items-center py-12">
                                    <Link :href="route('audit.users.index')"
                                        :active="route().current('audit.users.index')"
                                        class="text-teal-600 hover:text-emerald-400 col-span-1 flex flex-col items-center max-w-max">
                                    <mdicon name="account-group" title="Auditar Usuários" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Usuários
                                    </span>
                                    </Link>
                                </div>

                                <div class="flex flex-col items-center pt-12 pb-24">
                                    <Link :href="route('audit.permissions.index')"
                                        :active="route().current('audit.permissions.index')"
                                        class="text-teal-600 hover:text-emerald-400 flex flex-col items-center max-w-max">
                                    <mdicon name="key-arrow-right" title="Auditar Permissões" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Permissões
                                    </span>
                                    </Link>
                                </div>

                                <div class="flex flex-col items-center pt-12 pb-24">
                                    <Link :href="route('audit.roles.index')"
                                        :active="route().current('audit.roles.index')"
                                        class="text-teal-600 hover:text-emerald-400 flex flex-col items-center max-w-max">
                                    <mdicon name="key-chain" title="Auditar Papéis" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Papéis
                                    </span>
                                    </Link>
                                </div>

                                <div class="flex flex-col items-center pt-12 pb-24">
                                    <Link :href="route('dashboard')" :active="route().current('dashboard')"
                                        class="text-teal-600 hover:text-emerald-400 flex flex-col items-center max-w-max">
                                    <mdicon name="shield-lock-outline" title="Auditar Controle de Acessos" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Controle de Acessos
                                    </span>
                                    </Link>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
