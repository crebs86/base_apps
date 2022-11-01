<script setup>
import { onMounted, ref } from 'vue';
import { useToast } from "vue-toastification";
import { Link, Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SimpleModal from '@/Components/Common/SimpleModal.vue';
import axios from 'axios';
import { emittery } from '../../events'

onMounted: {
    emittery.on('getPermissionsListForm', async () => {
        getPermissionsListForm();
    })
}

const props = defineProps({
    rolesWithPermissions: Object
})

const toast = useToast();

const rolesWithPermissions = ref(props.rolesWithPermissions);

const permissionsList = ref({});
const newRole = ref('');
const message = ref({ mesage: '', code: 0 });

function saveNewRole() {
    axios.post(route('admin.acl.role.new'),
        {
            name: newRole.value,
            permissions: []
        }
    ).then(r => {
        message.value = {
            message: r.data,
            code: r.status
        };
    }).catch(e => {
        message.value = e.response;
        message.value = {
            message: e.response.data.message,
            code: e.response.status
        }
    })
}

function getPermissionsListForm() {
    axios.get(route('admin.acl.permissions.list.form'))
        .then(r => {
            permissionsList.value = r.data;
        }).catch(e => {
            toast.error('Erro ao buscar lista de permissões: ' + e.response.data.mesage)
        })

}

function teste() {
    emittery.emit('getPermissionsListForm')
}
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
                    <SimpleModal :loadData="'getPermissionsListForm'">
                        <template #button_title>Papéis</template>
                        <template #title>Novo Papél</template>
                        <template #body>
                            <div>
                                <form>
                                    <div class="grid xl:grid-cols-2 xl:gap-6">
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input type="text" id="full_name" v-model="newRole"
                                                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-grenn-400 appearance-none dark:border-gray-600 dark:focus:border-green-400 focus:outline-none focus:ring-0 focus:border-yellow-600 peer"
                                                placeholder=" " />
                                            <label for="full_name"
                                                class="absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-green-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Nome do Papél
                                            </label>
                                        </div>
                                    </div>
                                </form>
                                <div v-if="message?.message">
                                    <div :class="message?.code === 200 && message?.code !== 0 ? 'bg-green-500' : 'bg-red-500'"
                                        class="text-sm text-white rounded-md shadow-lg mx-auto py-4 px-1" role="alert">
                                        <div class="flex p-4">
                                            {{ message?.message }}
                                        </div>
                                    </div>
                                </div>
                                <div class="permissions_content">
                                    Permissões do papel
                                    <tr v-for="(v, i) in permissionsList" :key="i">
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            {{ v.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-blue-200 rounded border-gray-300 focus:ring-green-500 focus:ring-2" />
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </template>
                        <template #button>
                            <button type="button" @click.prevent="saveNewRole"
                                class="border border-green-600 bg-green-600 text-white hover:text-green-500 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 hover:bg-green-100 focus:outline-none focus:shadow-outline">
                                Salvar
                            </button>
                        </template>
                    </SimpleModal>
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
                                                    <tr v-for="(v, i) in rolesWithPermissions" :key="i">
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
                                                            <div class="grid grid-cols-4 gap-6">
                                                                <Link :href="route('admin.acl.role.show', v.id)">
                                                                <mdicon name="playlist-edit" class="text-blue-600"
                                                                    title="Editar" />
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
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
@media only screen and (max-height: 568px) {
    .permissions_content {
        height: 200px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 667px) {
    .permissions_content {
        height: 300px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 736px) {
    .permissions_content {
        height: 350px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 896px) {
    .permissions_content {
        height: 470px;
        overflow-y: scroll;
    }
}

@media only screen and (min-height: 897px) {
    .permissions_content {
        height: 500px;
        overflow-y: scroll;
    }
}
</style>