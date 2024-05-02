<script setup>
import { ref } from 'vue';
import { toast } from '../../toast'
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import moment from 'moment';
import InnerSection from './InnerSection.vue';

const props = defineProps(
    {
        'user': Object,
        'keyword': String
    }
)



const aclData = ref([]);

const getUser = useForm({
    user: props.keyword
});

const users = ref({});
const user = ref({});

const roles = ref({});

const labels = ref({
    'user_id': 'Usuário',
    'name': 'Nome',
    'roles': 'Papéis',
    'updated_at': 'Atribuição'
});

function search() {
    if (!(getUser.user === undefined || getUser.user === '' || getUser.user === null)) {
        getUser.get(route('audit.acl.index'));
        if (isNaN(parseInt(getUser.user))) {
            toast.error("Insira um número válido");
        }
    } else {
        toast.error("Informe o ID do usuário");
    }
}

function loadData() {
    axios.get(route('audit.acl.show', usePage().props.user?.id))
        .then(r => {
            aclData.value = r.data.aclData;
            users.value = r.data.users;
            roles.value = r.data.roles;
        })
        .catch(e => {
            if (e.response.status === 404) {
                toast.info("Não há dados para exibir.");
            }
        })
}

</script>
<template>
    <InnerSection>
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
                    <input type="text" v-model="getUser.user" @keypress.prevent.enter="search" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 p-2.5 rounded-md dark:bg-gray-600 dark:text-gray-300"
                        placeholder="Informe o código do usuário">
                </div>
                <button type="submit" :disabled="getUser.processing"
                    class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <!-- search icon -->
                    <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Buscar
                </button>
            </form>

            <div v-if="usePage().props.user" class="px-2 md:px-8 pt-1">
                <h3 class="text-xl font-bold">Identificação do Usuário</h3>

                <p class="pt-4 pb-2">
                    <strong>
                        Código:
                    </strong> {{ usePage().props.user?.id }}
                </p>

                <p class="py-2">
                    <strong>
                        Nome:
                    </strong> {{ usePage().props.user?.name }}
                </p>
                <hr>
                <p>
                    Papéis Atribuídos:
                </p>
                <span v-for="(roles, i) in usePage().props.user?.roles"
                    class="relative inline-block px-2 py-0 font-semibold text-green-900 leading-tight m-0.5 mb-1.5">
                    <span aria-hidden class="absolute inset-0 opacity-50 rounded-full bg-green-200 border border-green-600">
                    </span>
                    <span class="relative text-xs">
                        {{ roles.name }}
                    </span>
                </span>
                <hr>
                <button type="button" @click="loadData"
                    class="border border-teal-500 bg-teal-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline">
                    Carregar Dados de Auditoria
                </button>
            </div>
        </template>
    </InnerSection>
    <InnerSection v-if="Object.entries(aclData).length > 0">
        <tamplate #header>
            Dados de Atualizações do Controle de Acessso do Usuário: {{ usePage().props.user?.id }} -
            {{ usePage().props.user?.name }}
        </tamplate>
        <template #content>
            <div class="overflow-x-auto">
                <table class="min-w-full mb-2 px-1">
                    <thead>
                        <tr>
                            <th
                                class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 leading-4 tracking-wider bg-red-300 text-gray-800 text-center">
                                Coluna
                            </th>
                            <th v-for="(value, index) in aclData?.updated_at" :key="index"
                                class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 leading-4 tracking-wider bg-gray-500 text-gray-100 text-center">
                                {{ value !== '0000-00-00'
                                    ? moment(value).format('DD/MM/YYYY HH:mm:ss')
                                    : '-' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center bg-gray-500 text-gray-100">
                        <tr v-for="(v, i) in aclData" :key="i">
                            <th
                                class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-400 text-center text-gray-800 bg-red-300">
                                {{ labels[i] }}
                            </th>
                            <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-400 text-center"
                                v-for="(value, index) in v" :key="i + '' + index">
                                <template v-if="i === 'user_id'">
                                    {{ users[value]['name'] }}
                                </template>
                                <template v-else-if="i === 'roles'">
                                    <span v-for="(p, pi) in value"
                                        class="relative inline-block px-2 py-0 font-semibold text-green-900 leading-tight m-0.5">
                                        <span aria-hidden
                                            class="absolute inset-0 opacity-50 rounded-full bg-green-200 border border-green-600">
                                        </span>
                                        <span class="relative text-xs">
                                            {{ roles[p]['name'] }}
                                        </span>
                                    </span>
                                </template>
                                <template v-else-if="i === 'updated_at' || i === 'deleted_at'">
                                    {{ value && value !== '0000-00-00'
                                        ? moment(value).format('DD/MM/YYYY HH:mm:ss') : '-' }}
                                </template>
                                <template v-else>{{ value }}</template>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </InnerSection>
</template>