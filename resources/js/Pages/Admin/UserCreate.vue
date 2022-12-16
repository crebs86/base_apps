<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { useToast } from "vue-toastification";
import hasPermission from '@/permissions'

const toast = useToast();

const user = useForm({
    name: '',
    email: '',
    cpf: '',
    branch_id: '',
    notes: ''
})

function createUser() {
    user.post(route('admin.acl.usuarios.store'), {
        onSuccess: () => {
            if (usePage().props.value.flash.success) {
                toast.success(usePage().props.value.flash.success);
            } else if (usePage().props.value.flash.error) {
                toast.error(usePage().props.value.flash.error);
            }

        },
        onError: () => {
            if (usePage().props.value.errors) {
                toast.error('Foram encontrado erros ao processar sua solicitação');
            }
        },
    })
}

</script>

<template>

    <Head title="Criar Usuário" />

    <AuthenticatedLayout>

        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg font-bold text-center mb-2 text-gray-800 mx-1.5 rounded flex justify-center">
                Novo Usuário
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="pt-0.5" v-if="usePage().props.value.flash.info">
                    <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                        <div class="p-3 text-center">
                            {{ usePage().props.value.flash.info }}
                        </div>
                    </div>
                </div>
                <div class="mx-auto dark:bg-gray-800 p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">

                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="name" id="name" v-model="user.name"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="name"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 text-gray-900 dark:text-gray-300">
                                        Nome
                                    </label>
                                    <div v-if="usePage().props.value.errors.name" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.name }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="email" name="email" id="email" v-model="user.email"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="email"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 text-gray-900 dark:text-gray-300">
                                        E-mail
                                    </label>
                                    <div v-if="usePage().props.value.errors.email" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="cpf" id="cpf" v-model="user.cpf"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="cpf"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 text-gray-900 dark:text-gray-300">
                                        CPF
                                    </label>
                                    <div v-if="usePage().props.value.errors.cpf" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.cpf }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <select name="branch_id" id="branch_id" v-model="user.branch_id"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="" selected>selecione</option>
                                        <option v-for="branch in usePage().props.value.branches" :value="branch.id"
                                            :key="('branch' + branch.id)">
                                            {{ branch.name }}
                                        </option>
                                    </select>
                                    <label for="branch_id"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 text-gray-900 dark:text-gray-300">
                                        Unidade
                                    </label>
                                    <div v-if="usePage().props.value.errors.branch_id" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.branch_id }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <textarea type="text" name="notes" id="notes" v-model="user.notes"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="notes"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 text-gray-900 dark:text-gray-300">
                                        Observações
                                    </label>
                                    <div v-if="usePage().props.value.errors.notes" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.notes }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="user.reset()"
                                    class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-800 focus:outline-none focus:shadow-outline">
                                    Limpar
                                </button>
                                <button type="button" @click.prevent="createUser"
                                    v-if="hasPermission(usePage().props.value.auth.permissions, ['Cliente Editar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                                    class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                                    Criar Usuário
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
