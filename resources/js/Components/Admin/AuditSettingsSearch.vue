<script setup>
import { ref, computed, reactive } from 'vue';
import { useToast } from "vue-toastification";
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import moment from 'moment';

const props = defineProps(
    {
        'setting': Object
    }
)

const toast = useToast();

const selected = ref(null);

const setting = ref(props.setting);

const getSetting = computed(() => {
    settingData.value = [];
    return setting.value.filter((n) => n.id === selected.value)
});

const settingData = ref([]);

const users = ref({});

const labels = ref({
    'user_id': 'Usuário',
    'name': 'Nome',
    'settings': 'Configurações',
    'updated_at': 'Atualização'
});

function loadData() {
    axios.get(route('audit.setting.show', selected.value))
        .then(r => {
            settingData.value = r.data.settingData;
            users.value = r.data.users;
            keys.value = r.data.keys;
        })
        .catch((e) => {
            if (e?.response?.status === 404) {
                toast.info("Não há dados para exibir.");
            }
        })
}

</script>
<template>

    <div class="pt-0.5" v-if="usePage().props.value.flash.info">
        <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
            <div class="p-3 text-center">
                {{ usePage().props.value.flash.info }}
            </div>
        </div>
    </div>
    <form class="flex items-center h-5/6 px-1 mx-1" @submit.prevent="">
        <label for="select" class="pr-1.5">Configuração </label>
        <div class="relative w-full">
            <select id="select" v-model="selected" @keypress.prevent.enter="search" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 p-2.5 rounded-md dark:bg-gray-600 dark:text-gray-300">
                <option v-for="(s, i) in props.setting" :value="s.id" :key="s + i">{{ s.name }}</option>
            </select>
        </div>
    </form>

    <div v-if="selected" class="px-2 md:px-8 pt-2.5">
        <h3 class="text-xl font-bold">Dados da Configuração</h3>
        <p class="pt-4 pb-2">
            <strong>
                Código:
            </strong> {{ getSetting[0]?.id }}
        </p>

        <p class="py-2">
            <strong>
                Nome:
            </strong> {{ getSetting[0]?.name }}
        </p>

        <p class="pt-2 pb-4">
            <strong>
                Última alteração:
            </strong>
            {{ moment(getSetting[0]?.updated_at).format('DD/MM/YYYY HH:mm:ss') }}
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
                    <div v-if="Object.entries(settingData).length > 0"
                        class="inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                        <h1
                            class="text-lg font-bold text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded flex justify-center">
                            Dados de Atualizações da Configuração ID: {{ getSetting[0]?.id }} -
                            {{ getSetting[0]?.name }}
                        </h1>
                        <div class="py-2 overflow-x-auto mt-2 dark:bg-gray-800">
                            <table class="min-w-full mb-2 px-1">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-3 py-1.5 md:px-6 md:py-3 bg-red-100 text-center border-b-2 border-gray-300 text-left leading-4 tracking-wider dark:bg-red-300 text-gray-800">
                                            Coluna
                                        </th>
                                        <th v-for="(value, index) in settingData?.updated_at" :key="index"
                                            class="px-3 py-1.5 md:px-6 md:py-3 bg-gray-100 text-center border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider dark:bg-gray-700 dark:text-gray-300">
                                            {{ moment(value).format('DD/MM/YYYY HH:mm:ss') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white text-center dark:bg-gray-600">
                                    <tr v-for="(v, i) in settingData" :key="i">
                                        <th
                                            class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500 text-center text-gray-800 bg-red-100 dark:bg-red-300">
                                            {{ labels[i] }}
                                        </th>
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500 text-center"
                                            v-for="(value, index) in v" :key="i + '' + index">
                                            <template v-if="i === 'settings'">
                                                <template v-for="(s, i) in value">

                                                    <div
                                                        v-if="Object.prototype.toString.call(s).indexOf('Object') > -1">
                                                        <template v-for="(k, ki) in Object.keys(s)">
                                                            <div v-if="typeof s[k] === 'string'">
                                                                {{ s[k] }}
                                                            </div>
                                                            <div v-if="typeof s[k] === 'object'" class="my-1.5">
                                                                {{ s[k][0] }}:

                                                                <span class="p-0.5 bg-green-200 text-black rounded-md">
                                                                    {{ s[k][1] }}
                                                                </span>
                                                            </div>
                                                        </template>
                                                    </div>
                                                    <div v-if="Object.prototype.toString.call(s).indexOf('Array') > -1">
                                                        {{ s[0] }}:
                                                        <span class="p-0.5 bg-green-200 text-black rounded-md">
                                                            {{ s[1] }}
                                                        </span>
                                                    </div>
                                                    <hr class="my-1">
                                                </template>
                                            </template>
                                            <template v-else-if="i === 'user_id'">
                                                {{ users[value]['name'] }}
                                            </template>
                                            <template v-else-if="i === 'updated_at' || i === 'deleted_at'">
                                                {{ value? moment(value).format('DD/MM/YYYY HH:mm:ss') : '' }}
                                            </template>
                                            <template v-else>
                                                {{ value }}
                                            </template>
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