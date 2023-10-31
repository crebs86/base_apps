<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { toast } from '../../toast'
import { ref } from 'vue';
import has from '@/arrayHelpers';
import moment from 'moment';
import swal from 'sweetalert';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';

const edit = ref(usePage().props.edit);

const client = useForm({
    id: usePage().props.client.id,
    name: usePage().props.client.name,
    email: usePage().props.client.email,
    cep: usePage().props.client.cep,
    address: usePage().props.client.address,
    cpf: usePage().props.client.cpf,
    phones: usePage().props.client.phones,
    notes: usePage().props.client.notes,
    branch_id: usePage().props.client.branch_id,
    _checker: usePage().props._checker
})

function saveClient() {
    client.put(route('clients.update', usePage().props.client.id), {
        onSuccess: () => {
            if (usePage().props.flash.success) {
                edit.value = false;
                toast.success(usePage().props.flash.success);
            } else if (usePage().props.flash.error) {
                toast.error(usePage().props.flash.error);
            }

        },
        onError: () => {
            if (usePage().props.errors) {
                toast.error('Foram encontrado erros ao processar sua solicitação');
            }
        },
    })
}

function deleteClient() {

    swal({
        title: "Desativar cadastro?",
        text: "Você está prestes a desativar o cadastro de " + usePage().props.client.name,
        icon: "error",
        buttons: ['Cancelar', 'Desativar'],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                client.delete(route('clients.destroy', usePage().props.client.id), {
                    onSuccess: () => {
                        if (usePage().props.flash.success) {
                            toast.success(usePage().props.flash.success);
                        } else if (usePage().props.flash.error) {
                            toast.error(usePage().props.flash.error);
                        }

                    },
                    onError: () => {
                        if (usePage().props.errors) {
                            toast.error('Não foi possível processar sua solicitação');
                        }
                    },
                })
            }
        });
}

function restoreClient() {
    swal({
        title: "Restaurar cadastro?",
        text: "Você está prestes a reativar o cadastro de " + usePage().props.client.name,
        icon: "warning",
        buttons: ['Cancelar', 'Restaurar'],
        dangerMode: true,
    })
        .then((willRestore) => {
            if (willRestore) {
                client.put(route('clients.restore', usePage().props.client.id), {
                    onSuccess: () => {
                        if (usePage().props.flash.success) {
                            toast.success(usePage().props.flash.success);
                        } else if (usePage().props.flash.error) {
                            toast.error(usePage().props.flash.error);
                        }
                    },
                    onError: () => {
                        if (usePage().props.errors) {
                            toast.error('Não foi possível processar sua solicitação');
                        }
                    },
                })
            }
        });
}

</script>

<template>
    <Head title="Editar Cliente" />
    <AuthenticatedLayout>
        <SubSection>
            <template #header>
                Dados do cliente: {{ usePage().props.client.name }}
            </template>
            <template #content>
                    <!-- <div v-if="changeEmail">
                    <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                        <div class="flex p-4">
                            Ao alterar seu e-mail poderá ser solicitado sua verificação antes de poder usar a sua conta
                            novamente. Confira com cuidado o endereço digitado.
                        </div>
                    </div>
                </div> -->
                <InnerSection>
                    <template #content>
                        <div class="pt-0.5" v-if="usePage().props.flash.info">
                            <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                                <div class="p-3 text-center">
                                    {{ usePage().props.flash.info }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg">
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
                                    <div v-if="usePage().props.errors.name" class="text-sm text-red-500">
                                        {{ usePage().props.errors.name }}
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
                                    <div v-if="usePage().props.errors.email" class="text-sm text-red-500">
                                        {{ usePage().props.errors.email }}
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
                                    <div v-if="usePage().props.errors.cpf" class="text-sm text-red-500">
                                        {{ usePage().props.errors.cpf }}
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
                                    <div v-if="usePage().props.errors.cep" class="text-sm text-red-500">
                                        {{ usePage().props.errors.cep }}
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
                                    <div v-if="usePage().props.errors.address" class="text-sm text-red-500">
                                        {{ usePage().props.errors.address }}
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
                                    <div v-if="usePage().props.errors.phones" class="text-sm text-red-500">
                                        {{ usePage().props.errors.phones }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <select name="branch_id" id="branch_id" v-model="client.branch_id"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        :disabled="!edit">
                                        <option value="" selected>selecione</option>
                                        <option v-for="branch in usePage().props.branches" :value="branch.id"
                                            :key="('branch' + branch.id)">
                                            {{ branch.name }}
                                        </option>
                                    </select>
                                    <label for="branch_id"
                                        :class="!edit ? 'text-gray-400 dark:text-gray-600' : 'text-gray-900 dark:text-gray-300'"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Unidade
                                    </label>
                                    <div v-if="usePage().props.errors.branch_id" class="text-sm text-red-500">
                                        {{ usePage().props.errors.branch_id }}
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
                                    <div v-if="usePage().props.errors.notes" class="text-sm text-red-500">
                                        {{ usePage().props.errors.notes }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <small>
                                    Criado:
                                    {{
                                        moment(usePage().props.client.created_at).format('DD/MM/YYYY HH:mm:ss')
                                    }}
                                </small>
                                <small>
                                    Atualizado:
                                    {{
                                        moment(usePage().props.client.updated_at).format('DD/MM/YYYY HH:mm:ss')
                                    }}
                                </small>
                                <small v-show="(usePage().props.client.deleted_at)">
                                    Desativado:
                                    {{
                                        moment(usePage().props.client.deleted_at).format('DD/MM/YYYY HH:mm:ss')
                                    }}
                                </small>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="edit = true"
                                    v-if="!edit && (has(usePage().props.auth.permissions, ['Cliente Editar', 'Cliente Apagar']) || has(usePage().props.auth.roles, ['Super Admin']))"
                                    class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline">
                                    Habilitar Edição
                                </button>
                                <template
                                    v-else-if="edit && (has(usePage().props.auth.permissions, ['Cliente Editar', 'Cliente Apagar']) || has(usePage().props.auth.roles, ['Super Admin']))">
                                    <button type="button" @click.prevent="edit = false"
                                        class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-800 focus:outline-none focus:shadow-outline">
                                        Cancelar
                                    </button>
                                    <button type="button" @click.prevent="saveClient"
                                        v-if="has(usePage().props.auth.permissions, ['Cliente Editar']) || has(usePage().props.auth.roles, ['Super Admin'])"
                                        class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                                        Atualizar Cliente
                                    </button>
                                    <button type="button" @click.prevent="deleteClient"
                                        v-if="usePage().props.client.deleted_at === null && (has(usePage().props.auth.permissions, ['Cliente Apagar']) || has(usePage().props.auth.roles, ['Super Admin']))"
                                        class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                                        Excluir Cliente
                                    </button>
                                    <button type="button" @click.prevent="restoreClient"
                                        v-if="usePage().props.client.deleted_at !== null && (has(usePage().props.auth.permissions, ['Cliente Apagar', 'Cliente Editar']) || has(usePage().props.auth.roles, ['Super Admin']))"
                                        class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline">
                                        Restaurar Cliente
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
                </InnerSection>
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>
