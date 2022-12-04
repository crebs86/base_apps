<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { useToast } from "vue-toastification";
import { ref } from 'vue';
import hasPermission from '@/permissions'

const toast = useToast();

const edit = ref(usePage().props.value.edit);

const client = useForm({
    id: usePage().props.value.client.id,
    name: usePage().props.value.client.name,
    email: usePage().props.value.client.email,
    cep: usePage().props.value.client.cep,
    address: usePage().props.value.client.address,
    cpf: usePage().props.value.client.cpf,
    phones: usePage().props.value.client.phones,
    notes: usePage().props.value.client.notes,
    branch_id: usePage().props.value.client.branch_id
})

function saveClient() {
    client.put(route('clients.update', usePage().props.value.client.id), {
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

    <Head title="Editar Cliente" />

    <AuthenticatedLayout>

        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded">
                Dados do cliente: {{ usePage().props.value.client.name }}
            </h1>
            <div v-if="changeEmail">
                <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                    <div class="flex p-4">
                        Ao alterar seu e-mail poderá ser solicitado sua verificação antes de poder usar a sua conta
                        novamente. Confira com cuidado o endereço digitado.
                    </div>
                </div>
            </div>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">

                            <div class="grid xl:grid-cols-3 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="hidden" name="id" id="id" v-model="client.id" />

                                    <input type="text" name="name" id="name" v-model="client.name"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " :readonly="!edit" />
                                    <label for="name"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Nome
                                    </label>
                                    <div v-if="usePage().props.value.errors.name" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.name }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="email" name="email" id="email" v-model="client.email"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " :readonly="!edit" />
                                    <label for="email"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        E-mail
                                    </label>
                                    <div v-if="usePage().props.value.errors.email" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.email }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="cpf" id="cpf" v-model="client.cpf"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " :readonly="!edit" />
                                    <label for="cpf"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        CPF
                                    </label>
                                    <div v-if="usePage().props.value.errors.cpf" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.cpf }}
                                    </div>
                                </div>
                            </div>

                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="cep" id="cep" v-model="client.cep"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " :readonly="!edit" />
                                    <label for="cep"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        CEP
                                    </label>
                                    <div v-if="usePage().props.value.errors.cep" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.cep }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="address" id="address" v-model="client.address"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " required :readonly="!edit" />
                                    <label for="address"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Endereço
                                    </label>
                                    <div v-if="usePage().props.value.errors.address" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.address }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="phones" id="phones" v-model="client.phones"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " required :readonly="!edit" />
                                    <label for="phones"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Telefones
                                    </label>
                                    <div v-if="usePage().props.value.errors.phones" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.phones }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <select name="branch_id" id="branch_id" v-model="client.branch_id"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :disabled="!edit">
                                        <option value="" selected>selecione</option>
                                        <option v-for="branch in usePage().props.value.branches" :value="branch.id"
                                            :key="('branch' + branch.id)">
                                            {{ branch.name }}
                                        </option>
                                    </select>
                                    <label for="branch_id"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Unidade
                                    </label>
                                    <div v-if="usePage().props.value.errors.branch_id" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.branch_id }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <textarea type="text" name="notes" id="notes" v-model="client.notes"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " required :readonly="!edit" />
                                    <label for="notes"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Observações
                                    </label>
                                    <div v-if="usePage().props.value.errors.notes" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.notes }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="edit = true"
                                    v-if="!edit && hasPermission(usePage().props.value.auth.permissions, ['Cliente Editar', 'Cliente Apagar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                                    class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline">
                                    Habilitar Edição
                                </button>
                                <template
                                    v-else-if="edit && hasPermission(usePage().props.value.auth.permissions, ['Cliente Editar', 'Cliente Apagar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])">
                                    <button type="button" @click.prevent="edit = false"
                                        class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-800 focus:outline-none focus:shadow-outline">
                                        Cancelar
                                    </button>
                                    <button type="button" @click.prevent="saveClient"
                                        v-if="hasPermission(usePage().props.value.auth.permissions, ['Cliente Editar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                                        class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                                        Atualizar Cliente
                                    </button>
                                    <button type="button"
                                        v-if="hasPermission(usePage().props.value.auth.permissions, ['Cliente Apagar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                                        class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                                        Excluir Cliente
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
