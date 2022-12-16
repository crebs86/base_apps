<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
import { Head, usePage } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';

const props = defineProps({
    permission: Object,
    _checker: String
})

const toast = useToast();

const permissionEdit = ref(props.permission);

function editPermission() {
    axios.post(route('admin.acl.permissions.permission.update', props.permission.id), {
        name: permissionEdit.value.name,
        _checker: props._checker
    })
        .then(r => {
            toast.success('Permissão renomeada.');
        })
        .catch(r => {
            let res = r.response
            if (res.status === 418) {
                toast.warning(res.data.message)
                if (res.data.reload) {
                    Inertia.reload();
                }
            } else {
                toast.error(res.data.message)
            }

        })
}

</script>
<template>

    <Head :title="'Editar: ' + $page.props.permission.name" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <div
            class="container mx-auto mt-1 text-justify px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">

            <h1 class="text-lg text-center my-2">Permissão:
                <strong>
                    {{ $page.props.permission.name }}
                </strong>
            </h1>
            <div class="py-0 px-0">
                <div class="pt-0.5" v-if="usePage().props.value.flash.info">
                    <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                        <div class="p-3 text-center">
                            {{ usePage().props.value.flash.info }}
                        </div>
                    </div>
                </div>
                <div class="relative flex items-top justify-center sm:items-center sm:pt-0 dark:bg-gray-600">
                    <div class="py-2 overflow-x-auto mt-2 dark:bg-gray-500">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg dark:bg-gray-500">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" id="full_name" v-model="$page.props.permission.name"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-grenn-400 appearance-none dark:border-gray-600 dark:focus:border-green-400 focus:outline-none focus:ring-0 focus:border-yellow-600 peer"
                                    required />
                                <label for="full_name"
                                    class="absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-green-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 dark:text-gray-300">
                                    Nome da Permissão
                                </label>
                            </div>
                            <button @click="editPermission"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2 hover:bg-blue-200 hover:text-blue-700">
                                Atualizar
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>