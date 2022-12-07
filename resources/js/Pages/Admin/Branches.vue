<script setup>

import { useToast } from "vue-toastification";
import { Link, Head, usePage } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';

const toast = useToast();

function saveNewRole() {
    if (newRole.value === '') {
        message.value = {
            message: 'Informe um nome para o novo papél!',
            code: 500
        };
    } else {

        let form = document.querySelector('#new_permissions_role');
        let values = serialize(form, { hash: true });
        axios.post(route('admin.acl.roles.new'),
            {
                name: newRole.value,
                permissions: values
            }
        ).then(r => {
            message.value = {
                message: r.data.message,
                code: r.status
            };

            rolesWithPermissions.value = r.data.rolesWithPermissions;

            form.reset();

        }).catch(e => {
            if (e.response.status === 403) {
                toast.error(e.response.data.message)
            } else {
                message.value = e.response;
                message.value = {
                    message: e.response.data.message,
                    code: e.response.status
                }
            }
        })
    }
}

</script>
<template>

    <Head title="Unidades" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-1 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
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
                                    <tr v-for="(v, i) in usePage().props.value.branches" :key="i">
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
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>