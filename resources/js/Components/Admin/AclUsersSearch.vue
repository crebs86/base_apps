<script setup>
import { ref } from 'vue';
import { toast } from '../../toast'
import { Link, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import InnerSection from './InnerSection.vue';

const props = defineProps(
    {
        'users': Object,
        'keyword': String
    }
)



const usersList = ref(props.users);
const searchUsers = ref(props.keyword);

function search() {
    if (!(searchUsers.value === undefined || searchUsers.value === '' || searchUsers.value === null)) {
        let s = parseInt(searchUsers.value) || 0
        if ((s === 0) && !(searchUsers.value.length < 4) || s !== 0) {
            router.get(route('admin.acl.users.index', { user: searchUsers.value }))
        } else {
            usersList.value = []
            toast.error("Para buscas por nome ou e-mail insira ao menos 4 caracteres");
        }

    } else {
        toast.error("Insira um termo para a busca");
    }
}

</script>
<template>
    <div class="pt-0.5" v-if="usePage().props.flash.info">
        <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
            <div class="p-3 text-center">
                {{ usePage().props.flash.info }}
            </div>
        </div>
    </div>
    <form class="flex items-center h-5/6 p-1 m-1" @submit.prevent="search()">
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
            <input type="text" v-model="searchUsers" @keypress.prevent.enter="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 p-2.5 rounded-md dark:bg-gray-600 dark:text-gray-300"
                placeholder="Busque por nome, CPF, e-mail ou ID">
        </div>
        <button type="submit"
            class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <!-- search icon -->
            <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>Buscar
        </button>
    </form>
    <small class="text-blue-500 ml-2 dark:text-gray-300">Para buscas por nome ou e-mail insira ao menos 4
        caracteres
    </small>
    <InnerSection>
        <template #content>
            <div class="mx-auto rounded-xl">

                <div class="overflow-x-auto">
                    <div class="sm:flex-1 sm:flex sm:items-center sm:justify-center mt-4 work-sans">
                        <div v-if="usersList?.total > 0">
                            <p class="text-sm leading-5 text-blue-700 dark:text-gray-300">
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
                            <p class="text-sm leading-5 text-blue-700 dark:text-gray-300">Nenhum resultado
                                encontrado</p>
                        </div>
                    </div>
                    <div class="sm:flex sm:items-center sm:justify-center mt-4 work-sans pb-4">
                        <div v-if="usersList?.links?.length > 3">
                            <nav class="relative z-0 inline-flex shadow-md">
                                <template v-for="(v, i) in usersList.links" :key="'link_'+i">
                                    <div v-if="v.link === null" v-html="v.label"></div>
                                    <Link v-else :href="v.url" v-html="v.label"
                                        class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 dark:bg-gray-600 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-gray-300 dark:hover:text-gray-800"
                                        :class="v.deleted_at ? 'bg-blue-300 text-white dark:bg-gray-100 dark:text-gray-800' : ''">
                                    </Link>
                                </template>
                            </nav>
                        </div>
                    </div>
                    <table class="min-w-full mb-2 dark:bg-gray-600">
                        <thead>
                            <tr>
                                <th v-for="(value, index) in ['ID', 'Nome', 'E-mail', 'CPF', 'Situação', 'Ações']"
                                    :key="index + '' + value"
                                    class="px-3 py-1.5 md:px-6 md:py-3 bg-gray-100 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider dark:bg-gray-700 dark:text-gray-300">
                                    {{ value }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-600">
                            <tr v-for="(v, i) in usersList?.data" :key="i">
                                <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500"
                                    v-for="(value, index) in v" :key="i.id + '' + index">
                                    <template v-if="index === 'deleted_at'">
                                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                            <span aria-hidden class="absolute inset-0 opacity-50 rounded-full"
                                                :class="value === null ? 'bg-green-500 text-green-300 dark:bg-green-800 dark:text-green-800' : 'bg-red-400 dark:bg-red-600'">
                                            </span>
                                            <span class="relative text-xs">{{ value === null ? 'ativo' :
                                                'inativo'
                                            }}
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
                                    <div class="flex justify-center gap-1">
                                        <Link :href="route('admin.acl.users.roles.list', v.id)">
                                        <mdicon name="shield-account" class="text-green-600 hover:text-green-400"
                                            title="Detalhar Papéis" />
                                        </Link>
                                        <Link :href="route('admin.acl.users.roles.show', v.id)">
                                        <mdicon name="shield-edit" class="text-blue-600 hover:text-blue-400"
                                            title="Editar Papéis" />
                                        </Link>
                                        <Link :href="route('admin.acl.users.edit', v.id)">
                                        <mdicon name="account-edit" class="text-yellow-400 hover:text-yellow-200"
                                            title="Editar Conta" />
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="sm:flex-1 sm:flex sm:items-center sm:justify-center mt-4 work-sans">
                        <div v-if="usersList?.total > 0">
                            <p class="text-sm leading-5 text-blue-700 dark:text-gray-300">
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
                    </div>
                    <div class="sm:flex-1 sm:flex sm:items-center sm:justify-center mt-4 work-sans pb-4">
                        <div v-if="usersList?.links?.length > 3">
                            <nav class="relative z-0 inline-flex shadow-sm">
                                <template v-for="(v, i) in usersList.links" :key="'link_'+i">
                                    <div v-if="v.link === null" v-html="v.label"></div>
                                    <Link v-else :href="v.url" v-html="v.label"
                                        class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary dark:bg-gray-600 dark:text-gray-300"
                                        :class="{ 'bg-blue-300 text-white dark:bg-white dark:text-gray-800': v.deleted_at }">
                                    </Link>
                                </template>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </InnerSection>
</template>