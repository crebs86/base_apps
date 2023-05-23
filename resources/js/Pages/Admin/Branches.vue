<script setup>

import { Link, Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';

</script>
<template>
    <Head title="Unidades" />

    <AuthenticatedLayout>
        <SubSection>
            <template #header>
                Unidades
                <Link :href="route('branches.create')" class="pl-1 ml-1">
                <mdicon name="source-branch-plus" title="Criar Unidade" class="justify-center" />
                </Link>
            </template>
            <template #content>
                <InnerSection class="mx-auto p-0.5 md:p-3 rounded-lg">
                    <template #content>
                        <div class="overflow-x-auto">
                            <div
                                class="align-middle inline-block min-w-full shadow overflow-hidden shadow-dashboard p-1 rounded-bl-lg rounded-br-lg dark:text-gray-300">
                                <table class="min-w-full mb-2 px-1">
                                    <thead>
                                        <tr>
                                            <th v-for="(value, index) in ['ID', 'Nome', 'CNPJ', 'e-mail', 'Endereço', 'Situação', 'Ações']"
                                                :key="index + '' + value"
                                                class="px-3 py-1.5 md:px-6 md:py-3 bg-gray-100 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider dark:bg-gray-700 dark:text-gray-300">
                                                {{ value }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-600">
                                        <tr v-for="(v, i) in usePage().props.branches" :key="i">
                                            <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500"
                                                v-for="(value, index) in v" :key="i.id + '' + index">
                                                <template v-if="index === 'deleted_at'">

                                                    <span
                                                        class="relative inline-block px-2 py-0 font-semibold text-green-900 leading-tight m-0.5">
                                                        <span aria-hidden
                                                            class="absolute inset-0 opacity-50 rounded-full border"
                                                            :class="v.deleted_at ? 'bg-red-200 border-red-600' : 'bg-green-200 border-green-600'">
                                                        </span>
                                                        <span class="relative text-xs">
                                                            {{ v.deleted_at ? 'inativo' : 'ativo' }}
                                                        </span>
                                                    </span>

                                                </template>
                                                <template v-else>
                                                    <div class="text-sm leading-5 text-blue-900 dark:text-gray-300">
                                                        {{ value }}
                                                    </div>
                                                </template>
                                            </td>
                                            <td
                                                class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                                <div class="grid grid-cols-2 gap-1">
                                                    <Link :href="route('branches.show', v.id)">
                                                    <mdicon name="source-branch-check"
                                                        class="text-green-600 hover:text-green-400" title="Ver Filial" />
                                                    </Link>
                                                    <Link :href="route('branches.edit', v.id)">
                                                    <mdicon name="source-branch-sync"
                                                        class="text-yellow-400 hover:text-yellow-200"
                                                        :title="'Editar filial' + v.name" />
                                                    </Link>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                </InnerSection>
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>