<script setup>
import { ref } from 'vue';
import { toast } from '../../toast'
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import moment from 'moment';
import InnerSection from './InnerSection.vue';

const props = defineProps(
    {
        'branch': Object,
        'keyword': String
    }
)



const branchData = ref([]);

const getBranch = useForm({
    branch: props.keyword
});

const users = ref({});

const labels = ref({
    'user_id': 'Usuário',
    'name': 'Nome',
    'cnpj': 'CNPJ',
    'email': 'E-mail',
    'address': 'Endereço',
    'cep': 'CEP',
    'phones': 'Contatos',
    'notes': 'Observações',
    'updated_at': 'Atualização',
    'deleted_at': 'Cadastro Desativado',
});

function search() {
    if (!(getBranch.branch === undefined || getBranch.branch === '' || getBranch.branch === null)) {
        getBranch.get(route('audit.branches.index'));
        if (isNaN(parseInt(getBranch.branch))) {
            toast.error("Insira um número válido de cadastro");
        }
    } else {
        toast.error("Informe o código da unidade");
    }
}

function loadData() {
    axios.get(route('audit.branches.show', props.branch?.id))
        .then(r => {
            branchData.value = r.data.branchData;
            users.value = r.data.users;
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
                    <input type="text" v-model="getBranch.branch" @keypress.prevent.enter="search" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 p-2.5 rounded-md dark:bg-gray-600 dark:text-gray-300"
                        placeholder="Informe o código da unidade">
                </div>
                <button type="submit" :disabled="getBranch.processing"
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

            <div v-if="props.branch" class="px-2 md:px-8 pt-1">
                <h3 class="text-xl font-bold">Dados gerais</h3>
                <p class="pt-4 pb-2">
                    <strong>
                        Código:
                    </strong> {{ props.branch?.id }}
                </p>

                <p class="py-2">
                    <strong>
                        Nome:
                    </strong> {{ props.branch?.name }}
                </p>

                <p class="py-2">
                    <strong>
                        CNPJ:
                    </strong> {{ props.branch?.cnpj }}
                </p>

                <p class="py-2">
                    <strong>
                        E-mail:
                    </strong> {{ props.branch?.email }}
                </p>

                <p class="py-2">
                    <strong>
                        CEP:
                    </strong> {{ props.branch?.cep }}
                </p>

                <p class="py-2">
                    <strong>
                        Telefones:
                    </strong> {{ props.branch?.phones }}
                </p>

                <p class="py-2">
                    <strong>
                        Endereço:
                    </strong> {{ props.branch?.address }}
                </p>

                <p class="py-2">
                    <strong>
                        Observações:
                    </strong> {{ props.branch?.notes }}
                </p>

                <p class="pt-2 pb-4">
                    <strong>
                        Última alteração:
                    </strong>
                    {{ moment(props.branch?.updated_at).format('DD/MM/YYYY HH:mm:ss') }}
                </p>

                <button type="button" @click="loadData"
                    class="border border-teal-500 bg-teal-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline">
                    Carregar Dados de Auditoria
                </button>
            </div>
        </template>
    </InnerSection>
    <InnerSection v-if="Object.entries(branchData).length > 0">
        <template #header>
            Dados de Atualizações do Cadastro da Unidade: {{ props.branch?.id }} - {{ props.branch?.name }}
        </template>
        <template #content>
            <div class="overflow-x-auto">
                <table class="min-w-full mb-2 px-1">
                    <thead>
                        <tr>
                            <th
                                class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 leading-4 tracking-wider bg-red-300 text-gray-800 text-center">
                                Coluna
                            </th>
                            <th v-for="(value, index) in branchData?.updated_at" :key="index"
                                class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 text-center leading-4 tracking-wider bg-gray-500 text-gray-100">
                                {{ value ? moment(value).format('DD/MM/YYYY HH:mm:ss') : '' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center bg-gray-500 text-gray-100">
                        <tr v-for="(v, i) in branchData" :key="i">
                            <th
                                class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-400 text-center text-gray-800 bg-red-300">
                                {{ labels[i] }}
                            </th>
                            <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-400 text-center"
                                v-for="(value, index) in v" :key="i + '' + index">
                                <template v-if="i === 'user_id'">
                                    {{ users[value]['name'] }}
                                </template>
                                <template v-else-if="i === 'updated_at' || i === 'deleted_at'">
                                    {{ value ? moment(value).format('DD/MM/YYYY HH:mm:ss') : '' }}
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