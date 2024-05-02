<script setup>
import { ref } from 'vue';
import { toast } from '../../toast'
import { Link, useForm, usePage } from '@inertiajs/vue3';
import InnerSection from './InnerSection.vue';

const props = defineProps(
    {
        'clients': Object,
        'keyword': String,
        'includeTrash': Boolean
    }
)



const clientsList = ref(props.clients);
const searchClients = useForm({
    client: props.keyword,
    includeTrash: props.includeTrash === true
});

function search() {
    if (!(searchClients.client === undefined || searchClients.client === '' || searchClients.client === null)) {
        let s = parseInt(searchClients.client) || 0
        if ((s === 0) && !(searchClients.client.length < 4) || s !== 0) {
            searchClients.get(route('clients.index'))
        } else {
            clientsList.value = []
            toast.error("Para buscas por nome ou e-mail insira ao menos 4 caracteres");
        }

    } else {
        toast.error("Insira um termo para a busca");
    }
}

</script>
<template>
    <InnerSection>
        <template #header>
            Clientes
            <Link :href="route('clients.create')" class="pl-1 ml-1">
            <mdicon name="account-plus" title="Criar Cliente" class="justify-center" />
            </Link>
        </template>
        <template #content>
            <div class="pt-0.5" v-if="usePage().props.flash.info">
                <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                    <div class="p-3 text-center">
                        {{ usePage().props.flash.info }}
                    </div>
                </div>
            </div>
            <form class="flex items-center h-5/6 px-1 mx-1" @submit.prevent="search()">
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
                    <input type="text" v-model="searchClients.client" @keypress.prevent.enter="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 p-2.5 rounded-md dark:bg-gray-600 dark:text-gray-300"
                        placeholder="Busque por nome, CPF, e-mail ou ID">
                </div>
                <button type="submit" :disabled="searchClients.processing"
                    class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <!-- search icon -->
                    <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>Buscar
                </button>
            </form>
            <div class="mx-0.5 p-1.5">
                <label class="flex items-center">
                    <input type="checkbox" v-model="searchClients.includeTrash"
                        class="rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-xs">Incluir contas desativadas</span>
                </label>
            </div>
            <small class="ml-2">
                Para buscas por nome ou e-mail insira ao menos 4 caracteres
            </small>
            <div class="py-0 px-0">
                <div class="mx-auto rounded-xl">
                    <div class="overflow-x-auto">
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-center mt-4 work-sans">
                            <div v-if="clientsList?.total > 0">
                                <p class="text-sm leading-5">
                                    Exibindo de
                                    <span class="font-medium">{{ clientsList.from }}</span>
                                    a
                                    <span class="font-medium">{{ clientsList.to }}</span>
                                    em
                                    <span class="font-medium">{{ clientsList.total }}</span>
                                    resultados
                                </p>
                            </div>
                            <div v-else>
                                <p class="text-sm leading-5">Nenhum resultado
                                    encontrado</p>
                            </div>
                        </div>
                        <div class="sm:flex sm:items-center sm:justify-center mt-4 work-sans pb-4">
                            <div v-if="clientsList?.links?.length > 3">
                                <nav class="relative z-0 inline-flex shadow-md">
                                    <template v-for="(v, i) in clientsList.links" :key="'link_'+i">
                                        <div v-if="v.link === null" v-html="v.label"></div>
                                        <Link v-else :href="v.url" v-html="v.label"
                                            class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 dark:bg-gray-600 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-gray-300 dark:hover:text-gray-800"
                                            :class="v.active ? 'bg-blue-300 dark:bg-gray-100 text-gray-800' : ''">
                                        </Link>
                                    </template>
                                </nav>
                            </div>
                        </div>
                        <table class="min-w-full mb-2">
                            <thead>
                                <tr class="bg-slate-500">
                                    <th v-for="(value, index) in ['ID', 'Nome', 'E-mail', 'CPF', 'Ações']"
                                        :key="index + '' + value"
                                        class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-slate-200">
                                        {{ value }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, i) in clientsList?.data" :key="i"
                                    :class="i % 2 ? 'bg-slate-400 text-gray-100' : 'bg-slate-300 text-gray-700'">
                                    <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500"
                                        v-for="(value, index) in v" :key="i.id + '' + index">
                                        <div class="text-sm leading-5">
                                            {{ value }}
                                        </div>
                                    </td>
                                    <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                        <div class="flex justify-center gap-1">
                                            <Link :href="route('clients.show', v.id)">
                                            <mdicon name="account-search" class="text-green-600 hover:text-green-400"
                                                title="Detalhar Cliente" />
                                            </Link>
                                            <Link :href="route('clients.edit', v.id)">
                                            <mdicon name="account-edit" class="text-yellow-400 hover:text-yellow-200"
                                                title="Editar Cliente" />
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-center mt-4 work-sans">
                            <div v-if="clientsList?.total > 0">
                                <p class="text-sm leading-5">
                                    Exibindo de
                                    <span class="font-medium">{{ clientsList.from }}</span>
                                    a
                                    <span class="font-medium">{{ clientsList.to }}</span>
                                    em
                                    <span class="font-medium">{{ clientsList.total }}</span>
                                    resultados
                                </p>
                            </div>
                            <div v-else>
                                <p class="text-sm leading-5">Nenhum resultado encontrado</p>
                            </div>
                        </div>
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-center mt-4 work-sans pb-4">
                            <div v-if="clientsList?.links?.length > 3">
                                <nav class="relative z-0 inline-flex shadow-sm">
                                    <template v-for="(v, i) in clientsList.links" :key="'link_'+i">
                                        <div v-if="v.link === null" v-html="v.label"></div>
                                        <Link v-else :href="v.url" v-html="v.label"
                                            class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary dark:bg-gray-600 dark:text-gray-300"
                                            :class="{ 'bg-blue-300 dark:bg-white text-gray-800': v.active }">
                                        </Link>
                                    </template>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </template>
    </InnerSection>
</template>