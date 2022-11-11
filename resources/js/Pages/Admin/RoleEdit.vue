<script setup>
import { ref, reactive, computed } from 'vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
import { Link, Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';

const props = defineProps({
    role: Object,
    permissions: Object,
    _checker: String
})

const changed = ref(false);

const toast = useToast();

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
    axios.post(route('admin.acl.role.permissions.update', props.role[0].id), {
        permissions: hasPermissions.value,
        name: props.role[0].name,
        _checker: props._checker
    })
        .then(r => {
            Inertia.reload()
            toast.success('Permissões do papél redefinidas.');
        })
        .catch(r => {
            let res = r.response
            if (res.status === 403) {
                toast.error(res.data)
            }
        })
}

</script>
<template>

    <Head title="Painel" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <div
            class="container mx-auto mt-1 text-justify px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">

            <h1 class="text-lg text-center my-2">Permissões do Papél:
                <strong>
                    {{ $page.props.role[0].name }}
                </strong>
            </h1>
            <div class="py-0 px-0">
                <div class="relative flex items-top justify-center sm:items-center sm:pt-0 dark:bg-gray-600">
                    <div class="py-2 overflow-x-auto mt-2 dark:bg-gray-500">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg dark:bg-gray-500">
                            <button @click="editRolePermission"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2"
                                :class="!changed ? 'bg-blue-200 hover:bg-blue-200' : ''" :disabled="!changed">
                                Atualizar
                            </button>
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
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            {{ v.id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            {{ v.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
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