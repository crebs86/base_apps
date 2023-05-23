<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { toast } from '../../toast'
import { Head, usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed, reactive } from '@vue/reactivity';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';

const props = defineProps({
    user: Object,
    userRoles: Object,
    _checker: String,
    edit: Boolean
})

const changed = ref(false);

const editRoles = reactive(props.userRoles);

const hasRoles = computed(() =>
    editRoles
        .filter(v => v.has)
        .map(v => v.name))

function checkRole(role) {
    return Object.keys(props.user.roles)
        .map(key => props.user.roles[key]['id'])
        .includes(role)
}

function editUserRole() {
    axios.post(route('admin.acl.users.roles.edit', props.user.id), {
        roles: hasRoles.value,
        _checker: props._checker
    })
        .then(r => {
            router.reload()
            toast.success('Papéis do usuário redefinidos.');
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
    <Head title="Editar Papéis" />
    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <SubSection>
            <template #header>
                <p>Editar Papéis/Perfis do Usuário</p>
            </template>
            <template #content>
                <InnerSection>
                    <template #content>
                        <div class="max-w-7xl mx-auto">
                            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                                <div
                                    class="relative flex items-top justify-center sm:items-center sm:pt-0">
                                    <div class="py-2 overflow-x-auto mt-2">
                                        <div class="pt-0.5" v-if="usePage().props.flash.info">
                                            <div
                                                class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                                                <div class="p-3 text-center">
                                                    {{ usePage().props.flash.info }}
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="border align-middle inline-block min-w-full shadow overflow-hidden shadow-dashboard px-1 md:px-8 pt-1 rounded-lg dark:text-gray-300">
                                            <h2
                                                class="font-semibold text-lg leading-tight text-blue-900 dark:text-gray-300 pb-4">
                                                <p><strong>Nome: </strong> {{ $page.props.user.name }}</p>
                                                <p><strong>E-mail: </strong>{{ $page.props.user.email }}</p>
                                                <p><strong>CPF: </strong>{{ $page.props.user.cpf }}</p>
                                            </h2>
                                            <button @click="editUserRole" v-if="$page.props.edit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                                :class="!changed ? 'bg-blue-200 hover:bg-blue-200' : ''"
                                                :disabled="!changed">
                                                Atualizar
                                            </button>
                                            <table class="min-w-full mb-2">
                                                <thead class="text-center dark:text-gray-300">
                                                    <tr>
                                                        <th v-for="(value, index) in ['#', 'Papel', $page.props.edit ? 'Atual/Alterar' : 'Atual']"
                                                            :key="index + '' + value"
                                                            class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 leading-4 text-blue-500 tracking-wider dark:text-gray-300">
                                                            {{ value }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white text-center dark:bg-gray-800 dark:text-gray-300">
                                                    <tr v-for="(v, i) in editRoles" :key="'role_' + v.id">
                                                        <td
                                                            class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                                            {{ v.id }}
                                                        </td>
                                                        <td
                                                            class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                                            {{ v.name }}
                                                        </td>
                                                        <td
                                                            class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                                            <input type="checkbox"
                                                                class="w-4 h-4 text-blue-600 bg-red-200 rounded border-gray-300 focus:ring-green-500 focus:ring-2"
                                                                :checked="checkRole(v.id)" disabled />
                                                            {{ $page.props.edit ? '/' : '' }}
                                                            <input type="checkbox" @click="changed = true"
                                                                v-if="$page.props.edit"
                                                                class="w-4 h-4 text-green-600 bg-gray-100 rounded border-gray-300 focus:ring-green-500 focus:ring-2"
                                                                :checked="checkRole(v.id)" v-model="v.has" />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button @click="editUserRole" v-if="$page.props.edit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2"
                                                :class="!changed ? 'bg-blue-200 hover:bg-blue-200' : ''"
                                                :disabled="!changed">
                                                Atualizar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </InnerSection>
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>