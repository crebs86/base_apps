<script setup>
import { ref } from 'vue';
import { useToast } from "vue-toastification";
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import moment from 'moment';

const props = defineProps(
    {
        'user': Object,
        'keyword': String
    }
)

const toast = useToast();

const userData = ref([]);

const users = ref({});

const branches = ref({});

const labels = ref({
    'user_id': 'Usuário',
    'name': 'Nome',
    'cpf': 'CPF',
    'email': 'E-mail',
    'address': 'Endereço',
    'branch_id': 'Unidade',
    'cep': 'CEP',
    'phones': 'Contatos',
    'notes': 'Observações',
    'email_verified_at': 'Verificação de e-mail',
    'updated_at': 'Atualização',
    'deleted_at': 'Conta Desativada',
});

const getUser = useForm({
    user: props.keyword
});

function search() {
    if (!(getUser.user === undefined || getUser.user === '' || getUser.user === null)) {
        getUser.get(route('audit.users.index'));
        if (isNaN(parseInt(getUser.user))) {
            toast.error("Insira um número válido de cadastro de usuário");
        }
    } else {
        toast.error("Informe o número de cadastro do usuário");
    }
}

function loadData() {
    axios.get(route('audit.users.show', props.user?.id))
        .then(r => {
            userData.value = r.data.userData;
            users.value = r.data.users;
            branches.value = r.data.branches;
        })
        .catch(e => {
            if (e.response.status === 404) {
                toast.info("Não há dados para exibir.");
            }
        })
}

</script>
<template>

    <div class="pt-0.5" v-if="usePage().props.value.flash.info">
        <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
            <div class="p-3 text-center">cd cd
                {{ usePage().props.value.flash.info }}
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
                placeholder="Informe o ID do usuário do sistema">
        </div>
        <button type="submit" :disabled="getUser.processing"
            class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <!-- search icon -->
            <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>Buscar
        </button>
    </form>
    <small class="text-blue-500 ml-2 dark:text-gray-300">
        Busca somente pelo ID do Usuário do Sistema
    </small>

    <div v-if="props.user" class="px-2 md:px-8 pt-1">
        <h3 class="text-xl font-bold">Dados gerais</h3>
        <p class="pt-4 pb-2">
            <strong>
                Identificador:
            </strong> {{ props.user?.id }}
        </p>

        <p class="py-2">
            <strong>
                Nome:
            </strong> {{ props.user?.name }}
        </p>

        <p class="py-2">
            <strong>
                E-mail:
            </strong> {{ props.user?.email }}
        </p>

        <p class="py-2">
            <strong>
                CPF:
            </strong> {{ props.user?.cpf }}
        </p>

        <p class="py-2">
            <strong>
                Observações:
            </strong> {{ props.user?.notes }}
        </p>

        <p class="pt-2 pb-4">
            <strong>
                Última alteração:
            </strong>
            {{ moment(props.user?.updated_at).format('DD/MM/YYYY HH:mm:ss') }}
        </p>
        <button type="button" @click="loadData"
            class="border border-teal-500 bg-teal-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline">
            Carregar Dados de Auditoria
        </button>
    </div>
    <div class="py-0 px-0">
        <div class="mx-auto dark:bg-gray-800 rounded-xl">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-800">
                <div class="relative flex items-top justify-center sm:items-center sm:pt-0 dark:bg-gray-800">
                    <div v-if="Object.entries(userData).length > 0"
                        class="inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                        <h1
                            class="text-lg font-bold text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded flex justify-center">
                            Dados de Atualizações da Conta {{ props.user?.id }} - {{ props.user?.name }}
                        </h1>
                        <div
                            class="py-2 overflow-x-auto mt-2 dark:bg-gray-800">
                            <table class="min-w-full mb-2 px-1">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-3 py-1.5 md:px-6 md:py-3 bg-red-100 text-center border-b-2 border-gray-300 text-left leading-4 tracking-wider dark:bg-red-300 text-gray-800">
                                            Coluna
                                        </th>
                                        <th v-for="(value, index) in userData?.updated_at" :key="index"
                                            class="px-3 py-1.5 md:px-6 md:py-3 bg-gray-100 text-center border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider dark:bg-gray-700 dark:text-gray-300">
                                            {{ moment(value).format('DD/MM/YYYY HH:mm:ss') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white text-center dark:bg-gray-600">
                                    <tr v-for="(v, i) in userData" :key="i">
                                        <th
                                            class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500 text-center text-gray-800 bg-red-100 dark:bg-red-300">
                                            {{ labels[i] }}
                                        </th>
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500 text-center"
                                            v-for="(value, index) in v" :key="i + '' + index">
                                            <template v-if="i === 'user_id'">
                                                {{ users[value]['name'] }}
                                            </template>
                                            <template v-else-if="i === 'branch_id'">
                                                {{ branches[value] ? branches[value]['name'] : '' }}
                                            </template>
                                            <template v-else-if="i === 'updated_at' || i === 'deleted_at' || i === 'email_verified_at'">
                                                {{ value ? moment(value).format('DD/MM/YYYY HH:mm:ss') : '' }}
                                            </template>
                                            <template v-else>{{ value }}</template>
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

</template>