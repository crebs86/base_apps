<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(
    {
        'users': Object,
        'keyword': String
    }
)

const toast = useToast();

const usersList = ref(props.users);
const searchUsers = ref(props.keyword);

function search() {
    if (!(searchUsers.value === undefined || searchUsers.value === '' || searchUsers.value === null)) {
        axios.post(route('admin.acl.users.search', searchUsers.value), { search: searchUsers.value })
            .then(r => {
                usersList.value = r.data.users
                if (usersList.value.length < 1) {
                    toast.warning("Nenhum usuário encontrado com estes termos");
                }
            }).catch(r => {
                if (r.response.status) {
                    toast.error(r.response.data);
                }
            })
    } else {
        toast.error("Insira um termo para a busca");
    }
}

</script>
<template>
    <h1 class="text-lg text-center mb-2">Usuários do Sistema</h1>
    <form class="flex items-center" @submit.prevent="search()">
        <label for="voice-search" class="sr-only">Buscar</label>
        <div class="relative w-full">
            <div class="flex absolute inset-y-0 left-0 items-center pl-1 pointer-events-none">
                <!-- search icon -->
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </div>
            <input type="text" v-model="searchUsers" @keyup.enter="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 p-2.5"
                placeholder="Busque por nome, CPF ou e-mail">
        </div>
        <button type="submit"
            class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <!-- search icon -->
            <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>Buscar
        </button>
    </form>
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
                                        <th v-for="(value, index) in ['ID', 'Nome', 'E-mail', 'CPF', 'Situação', 'Ações']"
                                            :key="index + '' + value"
                                            class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                            {{ value }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr v-for="(v, i) in usersList?.data" :key="i">
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                                            v-for="(value, index) in v" :key="i.id + '' + index">
                                            <template v-if="index === 'active'">
                                                <span
                                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 opacity-50 rounded-full"
                                                        :class="value === 1 ? 'bg-green-200' : 'bg-red-200'">
                                                    </span>
                                                    <span class="relative text-xs">{{ value === 1 ? 'ativo' :
                                                            'inativo'
                                                    }}
                                                    </span>
                                                </span>
                                            </template>
                                            <template v-else>
                                                <div class="text-sm leading-5 text-blue-900">{{ value }}</div>
                                            </template>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <div class="grid grid-cols-4 gap-6">

                                                <Link :href="route('admin.acl.user.roles.list', v.id)">
                                                <mdicon name="shield-account" class="text-green-600" title="Detalhes" />
                                                </Link>
                                                <Link :href="route('admin.acl.user.roles.show', v.id)">
                                                <mdicon name="shield-edit" class="text-blue-600" title="Editar" />
                                                </Link>
                                                <!-- <mdicon name="account-cancel" class="text-yellow-500"
                                                    title="Desativar" />
                                                <mdicon name="account-remove" class="text-red-500" title="Apagar" /> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans pb-4">
                                <div v-if="usersList?.total > 0">
                                    <p class="text-sm leading-5 text-blue-700">
                                        Exibindo de
                                        <span class="font-medium">{{ usersList.from }}</span>
                                        a
                                        <span class="font-medium">{{ usersList.to }}</span>
                                        em
                                        <span class="font-medium">{{ usersList.total }}</span>
                                        resultados
                                    </p>
                                </div>
                                <div v-else>
                                    <p class="text-sm leading-5 text-blue-700">Nenhum resultado encontrado</p>
                                </div>
                                <div v-if="usersList?.links?.length > 3">
                                    <nav class="relative z-0 inline-flex shadow-sm">
                                        <template v-for="(v, i) in usersList.links" :key="'link_'+i">
                                            <div v-if="v.link === null" v-html="v.label"></div>
                                            <Link v-else :href="v.url" v-html="v.label"
                                                class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"
                                                :class="{ 'bg-blue-300 text-white': v.active }">
                                            </Link>
                                        </template>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>