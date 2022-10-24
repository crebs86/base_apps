<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
import { Link, Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    roleWithPermissions: Object
})

const toast = useToast();

const roleWithPermissions = ref(props.roleWithPermissions);

</script>
<template>

    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Controle de Acesso
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-lg text-center my-2">Permissões do Papél: <strong>{{
                            $page.props.roleWithPermissions[0].name
                    }}</strong></h1>
                    <div class="py-0 px-0">
                        <div class="max-w-7xl mx-auto">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                <div class="relative flex items-top justify-center sm:items-center sm:pt-0">
                                    <div class="py-2 overflow-x-auto mt-2">
                                        <div
                                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                                            <table class="min-w-full mb-2">
                                                <thead>
                                                    <tr>
                                                        <th v-for="(value, index) in ['ID', 'Nome', 'Permissões', 'Ações']"
                                                            :key="index + '' + value"
                                                            class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                                            {{ value }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white">
                                                    <tr v-for="(v, i) in roleWithPermissions" :key="i">
                                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                                                            v-for="(value, index) in v" :key="i.id + '' + index">
                                                            <template v-if="index === 'permissions'">
                                                                <span v-for="(p, i) in v.permissions"
                                                                    class="relative inline-block px-2 py-0 font-semibold text-green-900 leading-tight m-0.5">
                                                                    <span aria-hidden
                                                                        class="absolute inset-0 opacity-50 rounded-full bg-green-200 border border-green-600">
                                                                    </span>
                                                                    <span class="relative text-xs">
                                                                        {{ p.name }}
                                                                    </span>
                                                                </span>
                                                            </template>
                                                            <template v-else>
                                                                <div class="text-sm leading-5 text-blue-900">
                                                                    {{ value }}
                                                                </div>
                                                            </template>
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                                            <!-- <div class="grid grid-cols-4 gap-6">
                                                                <Link :href="route('admin.acl.role.show', v.id)">
                                                                <mdicon name="playlist-edit" class="text-blue-600"
                                                                    title="Editar" />
                                                                </Link>
                                                                <Link :href="route('admin.acl.user.roles.list', v.id)">
                                                                <mdicon name="playlist-minus" class="text-yellow-500"
                                                                    title="Desativar" />
                                                                </Link>
                                                            </div> -->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>