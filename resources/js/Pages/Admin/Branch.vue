<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { toast } from '../../toast';
import { ref } from 'vue';
import has from '@/arrayHelpers';
import moment from 'moment';
import swal from 'sweetalert';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';

const edit = ref(usePage().props.edit);

const branch = useForm({
    id: usePage().props.branch.id,
    name: usePage().props.branch.name,
    email: usePage().props.branch.email,
    cep: usePage().props.branch.cep,
    address: usePage().props.branch.address,
    phones: usePage().props.branch.phones,
    cnpj: usePage().props.branch.cnpj,
    notes: usePage().props.branch.notes,
    _checker: usePage().props._checker
})

function saveBranch() {
    branch.put(route('branches.update', usePage().props.branch.id), {
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

function deleteBranch() {

    swal({
        title: "Desativar unidade?",
        text: "Você está prestes a desativar a unidade " + usePage().props.branch.name,
        icon: "error",
        buttons: ['Cancelar', 'Desativar'],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                branch.delete(route('branches.destroy', usePage().props.branch.id), {
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

function restoreBranch() {
    swal({
        title: "Restaurar unidade?",
        text: "Você está prestes a reativar a unidade " + usePage().props.branch.name,
        icon: "warning",
        buttons: ['Cancelar', 'Restaurar'],
        dangerMode: true,
    })
        .then((willRestore) => {
            if (willRestore) {
                branch.put(route('branches.restore', usePage().props.branch.id), {
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
    <Head title="Unidade " />

    <AuthenticatedLayout>
        <SubSection>
            <template #header>
                Dados da unidade: {{ usePage().props.branch.name }}
            </template>

            <template #content>
                <div class="pt-0.5" v-if="usePage().props.flash.info">
                    <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                        <div class="p-3 text-center">
                            {{ usePage().props.flash.info }}
                        </div>
                    </div>
                </div>
                <InnerSection>
                    <template #content>
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="name" id="name" v-model="branch.name"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " :readonly="!edit" />
                                <label for="name"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 z-0 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nome
                                </label>
                                <div v-if="usePage().props.errors.name" class="text-sm text-red-500">
                                    {{ usePage().props.errors.name }}
                                </div>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="email" name="email" id="email" v-model="branch.email"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " :readonly="!edit" />
                                <label for="email"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 z-0 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    E-mail
                                </label>
                                <div v-if="usePage().props.errors.email" class="text-sm text-red-500">
                                    {{ usePage().props.errors.email }}
                                </div>
                            </div>
                        </div>

                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="cep" id="cep" v-model="branch.cep"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " :readonly="!edit" />
                                <label for="cep"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 z-0 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    CEP
                                </label>
                                <div v-if="usePage().props.errors.cep" class="text-sm text-red-500">
                                    {{ usePage().props.errors.cep }}
                                </div>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="address" id="address" v-model="branch.address"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required :readonly="!edit" />
                                <label for="address"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 z-0 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Endereço
                                </label>
                                <div v-if="usePage().props.errors.address" class="text-sm text-red-500">
                                    {{ usePage().props.errors.address }}
                                </div>
                            </div>
                        </div>
                        <div class="grid xl:grid-cols-2 xl:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="phones" id="phones" v-model="branch.phones"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required :readonly="!edit" />
                                <label for="phones"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 z-0 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Telefones
                                </label>
                                <div v-if="usePage().props.errors.phones" class="text-sm text-red-500">
                                    {{ usePage().props.errors.phones }}
                                </div>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="cnpj" id="cnpj" v-model="branch.cnpj"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " :readonly="!edit" />
                                <label for="cnpj"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 z-0 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    CNPJ
                                </label>
                                <div v-if="usePage().props.errors.cnpj" class="text-sm text-red-500">
                                    {{ usePage().props.errors.cnpj }}
                                </div>
                            </div>
                        </div>
                        <div class="grid xl:grid-cols-1 xl:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <textarea type="text" name="notes" id="notes" v-model="branch.notes"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required :readonly="!edit" />
                                <label for="notes"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 z-0 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
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
                                    usePage().props.branch.created_at ? moment(usePage().props.branch.created_at).format('DD/MM/YYYY HH:mm:ss') : ''
                                }}
                            </small>
                            <small>
                                Atualizado:
                                {{
                                    usePage().props.branch.updated_at ? moment(usePage().props.branch.updated_at).format('DD/MM/YYYY HH:mm:ss') : ''
                                }}
                            </small>
                            <small v-show="(usePage().props.branch.deleted_at)">
                                Desativado:
                                {{
                                    usePage().props.branch.deleted_at ? moment(usePage().props.branch.deleted_at).format('DD/MM/YYYY HH:mm:ss') : ''
                                }}
                            </small>
                        </div>
                        <div class="text-center">
                            <button type="button" @click.prevent="edit = true"
                                v-if="!edit && (has(usePage().props.auth.permissions, ['Unidade Editar', 'Unidade Apagar']) || has(usePage().props.auth.roles, ['Super Admin']))"
                                class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline">
                                Habilitar Edição
                            </button>
                            <template
                                v-else-if="edit && (has(usePage().props.auth.permissions, ['Unidade Editar', 'Unidade Apagar']) || has(usePage().props.auth.roles, ['Super Admin']))">
                                <button type="button" @click.prevent="edit = false"
                                    class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-800 focus:outline-none focus:shadow-outline">
                                    Cancelar
                                </button>
                                <button type="button" @click.prevent="saveBranch"
                                    v-if="has(usePage().props.auth.permissions, ['Unidade Editar']) || has(usePage().props.auth.roles, ['Super Admin'])"
                                    class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                                    Atualizar Unidade
                                </button>
                                <button type="button" @click.prevent="deleteBranch"
                                    v-if="usePage().props.branch.deleted_at === null && (has(usePage().props.auth.permissions, ['Unidade Apagar']) || has(usePage().props.auth.roles, ['Super Admin']))"
                                    class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                                    Excluir Unidade
                                </button>
                                <button type="button" @click.prevent="restoreBranch"
                                    v-if="usePage().props.branch.deleted_at !== null && (has(usePage().props.auth.permissions, ['Unidade Apagar', 'Unidade Editar']) || has(usePage().props.auth.roles, ['Super Admin']))"
                                    class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline">
                                    Restaurar Unidade
                                </button>
                            </template>
                        </div>
                    </template>
                </InnerSection>
            </template>
        </SubSection>

    </AuthenticatedLayout>
</template>
