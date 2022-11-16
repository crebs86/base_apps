<script setup>
import { ref, reactive, computed } from 'vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';

const props = defineProps({
    role: Object,
    permissions: Object,
    _checker: String,
    edit_name: Boolean
})

const changed = ref(false);

const toast = useToast();

const roleName = ref(props.role[0].name)

const editPermissions = reactive(props.permissions);

const hasPermissions = computed(() =>
    editPermissions
        .filter(v => v.has)
        .map(v => v.name))

function checkPermission(permission) {
    return Object.keys(props.role[0].permissions)
        .map(key => props.role[0].permissions[key]['id'])
        .includes(permission)
}

function editRolePermission() {
    axios.post(route('admin.acl.roles.permissions.update', props.role[0].id), {
        permissions: hasPermissions.value,
        id: props.role[0].id,
        name: roleName.value,
        _checker: props._checker
    })
        .then(r => {
            Inertia.reload()
            toast.success('Permissões do papél redefinidas.');
        })
        .catch(r => {
            let res = r.response
            toast.error(res.data.message)
        })
}

</script>
<template>

    <Head :title="'Editar: ' + $page.props.role[0].name" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">

            <h1 class="text-lg text-center my-2">Permissões do Papél:
                <strong>
                    {{ $page.props.role[0].name }}
                </strong>
            </h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative flex items-top justify-center sm:items-center rounded-lg sm:pt-0 dark:bg-gray-800">
                    <div class="py-2 overflow-x-auto mt-2 dark:bg-gray-800">
                        <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-1 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                            <button @click="editRolePermission"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2"
                                :class="!changed ? 'bg-blue-200 hover:bg-blue-200' : ''" :disabled="!changed">
                                Atualizar
                            </button>

                            <div class="relative z-0 mb-6 w-full group" v-if="edit_name">
                                <input type="text" id="full_name" v-model="roleName" @input="changed = true"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-grenn-400 appearance-none dark:border-gray-600 dark:focus:border-green-400 focus:outline-none focus:ring-0 focus:border-yellow-600 peer"
                                    required />
                                <label for="full_name"
                                    class="absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-green-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 dark:text-gray-300">
                                    Nome do Papél
                                </label>
                            </div>

                            <table class="min-w-full mb-2 dark:bg-gray-600 dark:text-gray-200">
                                <thead>
                                    <tr>
                                        <th v-for="(value, index) in ['ID', 'Permissão', 'Atual/Alterar']"
                                            :key="index + '' + value"
                                            class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider dark:text-gray-300">
                                            {{ value }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white text-center dark:bg-gray-400">
                                    <tr v-for="(v, i) in editPermissions" :key="i">
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                            {{ v.id }}
                                        </td>
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                            {{ v.name }}
                                        </td>
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-red-200 rounded border-gray-300 focus:ring-green-500 focus:ring-2"
                                                :checked="checkPermission(v.id)" disabled />
                                            /
                                            <input type="checkbox" @click="changed = true"
                                                class="w-4 h-4 text-green-600 bg-gray-100 rounded border-gray-300 focus:ring-green-500 focus:ring-2"
                                                :checked="checkPermission(v.id)" v-model="v.has" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button @click="editRolePermission"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2"
                                :class="!changed ? 'bg-blue-200 hover:bg-blue-200' : ''" :disabled="!changed">
                                Atualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>