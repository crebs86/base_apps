<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
import { Link, Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { computed, reactive } from '@vue/reactivity';

const props = defineProps({
    user: Object,
    userRoles: Object,
    _checker: String,
    edit: Boolean
})

const changed = ref(false);

const toast = useToast();

const editRoles = reactive(props.userRoles);

const hasRoles = computed(() =>
    editRoles
        .filter(v => v.has)
        .map(v => v.name))

function checkRole(role) {
    return Object.keys(props.user[0].roles)
        .map(key => props.user[0].roles[key]['id'])
        .includes(role)
}

function editUserRole() {
    axios.post(route('admin.acl.user.roles.edit', props.user[0].id), {
        roles: hasRoles.value,
        _checker: props._checker
    })
        .then(r => {
            Inertia.reload()
            toast.success('Papéis do usuário redefinidos.');
        })
        .catch(r => {
            let res = r.response
            if(res.status === 403){
                toast.error(res.data)
            }
        })
}

</script>
<template>

    <Head title="Editar Papéis" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <p class="text-blue-900"><strong>Papéis de: </strong></p>
                <p class="text-blue-900">Nome: {{ $page.props.user[0].name }}</p>
                <p class="text-blue-900">E-mail: {{ $page.props.user[0].email }}</p>
                <p class="text-blue-900">CPF: {{ $page.props.user[0].cpf }}</p>
            </h2>
        </template>
        <div class="py-0 px-0 mt-3">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="relative flex items-top justify-center sm:items-center sm:pt-0">
                        <div class="py-2 overflow-x-auto mt-2">
                            <div
                                class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                                <button @click="editUserRole" v-if="$page.props.edit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                    :class="!changed ? 'bg-blue-200 hover:bg-blue-200' : ''" :disabled="!changed">
                                    Atualizar
                                </button>
                                <button @click="$page.props.edit = true, changed = false" v-if="!$page.props.edit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                    Editar
                                </button>
                                <table class="min-w-full mb-2">
                                    <thead class="text-center">
                                        <tr>
                                            <th v-for="(value, index) in ['#', 'Papel', $page.props.edit ? 'Atual/Alterar' : 'Atual']"
                                                :key="index + '' + value"
                                                class="px-6 py-3 border-b-2 border-gray-300 leading-4 text-blue-500 tracking-wider">
                                                {{ value }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white text-center">
                                        <tr v-for="(v, i) in editRoles" :key="'role_' + v.id">
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                                {{ v.id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                                {{ v.name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                                <input type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-red-200 rounded border-gray-300 focus:ring-green-500 focus:ring-2"
                                                    :checked="checkRole(v.id)" disabled />
                                                {{ $page.props.edit ? '/' : '' }}
                                                <input type="checkbox" @click="changed = true" v-if="$page.props.edit"
                                                    class="w-4 h-4 text-green-600 bg-gray-100 rounded border-gray-300 focus:ring-green-500 focus:ring-2"
                                                    :checked="checkRole(v.id)" v-model="v.has" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button @click="editUserRole" v-if="$page.props.edit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2"
                                    :class="!changed ? 'bg-blue-200 hover:bg-blue-200' : ''" :disabled="!changed">
                                    Atualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>