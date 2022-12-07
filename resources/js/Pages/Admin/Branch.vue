<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { useToast } from "vue-toastification";
import { ref } from 'vue';
import hasPermission from '@/permissions';
import moment from 'moment';
import swal from 'sweetalert';

const toast = useToast();

const edit = ref(usePage().props.value.edit);

const branch = useForm({
    id: usePage().props.value.branch.id,
    name: usePage().props.value.branch.name,
    email: usePage().props.value.branch.email,
    cep: usePage().props.value.branch.cep,
    address: usePage().props.value.branch.address,
    phones: usePage().props.value.branch.phones,
    cnpj: usePage().props.value.branch.cnpj,
    notes: usePage().props.value.branch.notes,
    _checker: usePage().props.value._checker
})

function saveBranch() {
    branch.put(route('branches.update', usePage().props.value.branch.id), {
        onSuccess: () => {
            if (usePage().props.value.flash.success) {
                edit.value = false;
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

function deleteBranch() {

    swal({
        title: "Desativar unidade?",
        text: "Você está prestes a desativar a unidade " + usePage().props.value.branch.name,
        icon: "error",
        buttons: ['Cancelar', 'Desativar'],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                branch.delete(route('branches.destroy', usePage().props.value.branch.id), {
                    onSuccess: () => {
                        if (usePage().props.value.flash.success) {
                            toast.success(usePage().props.value.flash.success);
                        } else if (usePage().props.value.flash.error) {
                            toast.error(usePage().props.value.flash.error);
                        }

                    },
                    onError: () => {
                        if (usePage().props.value.errors) {
                            toast.error('Não foi possível processar sua solicitação');
                        }
                    },
                })
            }
        });
}

function restoreBranch() {
    swal({
        title: "Restaurar unidade?",
        text: "Você está prestes a reativar a unidade " + usePage().props.value.branch.name,
        icon: "warning",
        buttons: ['Cancelar', 'Restaurar'],
        dangerMode: true,
    })
        .then((willRestore) => {
            if (willRestore) {
                branch.put(route('branches.restore', usePage().props.value.branch.id), {
                    onSuccess: () => {
                        if (usePage().props.value.flash.success) {
                            toast.success(usePage().props.value.flash.success);
                        } else if (usePage().props.value.flash.error) {
                            toast.error(usePage().props.value.flash.error);
                        }

                    },
                    onError: () => {
                        if (usePage().props.value.errors) {
                            toast.error('Não foi possível processar sua solicitação');
                        }
                    },
                })
            }
        });
}

</script>

<template>

    <Head title="unidade" />

    <AuthenticatedLayout>

        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded">
                Dados da unidade: {{ usePage().props.value.branch.name }}
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">

                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">

                                    <input type="text" name="name" id="name" v-model="branch.name"
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
                                    <input type="email" name="email" id="email" v-model="branch.email"
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
                            </div>

                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="cep" id="cep" v-model="branch.cep"
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
                                    <input type="text" name="address" id="address" v-model="branch.address"
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
                                    <input type="text" name="phones" id="phones" v-model="branch.phones"
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
                                    <input type="text" name="cnpj" id="cnpj" v-model="branch.cnpj"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        placeholder=" " :readonly="!edit" />
                                    <label for="cnpj"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        CNPJ
                                    </label>
                                    <div v-if="usePage().props.value.errors.cnpj" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.cnpj }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <textarea type="text" name="notes" id="notes" v-model="branch.notes"
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
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <small>
                                    Criado:
                                    {{
                                            moment(usePage().props.value.branch.created_at).format('DD/MM/YYYY HH:mm:ss')
                                    }}
                                </small>
                                <small>
                                    Atualizado:
                                    {{
                                            moment(usePage().props.value.branch.updated_at).format('DD/MM/YYYY HH:mm:ss')
                                    }}
                                </small>
                                <small v-show="(usePage().props.value.branch.deleted_at)">
                                    Desativado:
                                    {{
                                            moment(usePage().props.value.branch.deleted_at).format('DD/MM/YYYY HH:mm:ss')
                                    }}
                                </small>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="edit = true"
                                    v-if="!edit && (hasPermission(usePage().props.value.auth.permissions, ['Unidade Editar', 'Unidade Apagar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin']))"
                                    class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline">
                                    Habilitar Edição
                                </button>
                                <template
                                    v-else-if="edit && (hasPermission(usePage().props.value.auth.permissions, ['Unidade Editar', 'Unidade Apagar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin']))">
                                    <button type="button" @click.prevent="edit = false"
                                        class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-800 focus:outline-none focus:shadow-outline">
                                        Cancelar
                                    </button>
                                    <button type="button" @click.prevent="saveBranch"
                                        v-if="hasPermission(usePage().props.value.auth.permissions, ['Unidade Editar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                                        class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                                        Atualizar Unidade
                                    </button>
                                    <button type="button" @click.prevent="deleteBranch"
                                        v-if="usePage().props.value.branch.deleted_at === null && (hasPermission(usePage().props.value.auth.permissions, ['Unidade Apagar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin']))"
                                        class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                                        Excluir Unidade
                                    </button>
                                    <button type="button" @click.prevent="restoreBranch"
                                        v-if="usePage().props.value.branch.deleted_at !== null && (hasPermission(usePage().props.value.auth.permissions, ['Unidade Apagar', 'Unidade Editar']) || hasPermission(usePage().props.value.auth.roles, ['Super Admin']))"
                                        class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline">
                                        Restaurar Unidade
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
