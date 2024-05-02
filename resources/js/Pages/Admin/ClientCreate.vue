<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { toast } from '../../toast';
import has from '@/arrayHelpers';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';

const client = useForm({
    name: '',
    email: '',
    cep: '',
    address: '',
    cpf: '',
    phones: '',
    notes: '',
    branch_id: ''
})

function createClient() {
    client.post(route('clients.store'), {
        onSuccess: () => {
            if (usePage().props.flash.success) {
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

</script>

<template>
    <Head title="Criar Cliente" />

    <AuthenticatedLayout>
        <SubSection>
            <template #header>
                Novo Cliente
            </template>
            <template #content class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="pt-0.5" v-if="usePage().props.flash.info">
                    <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                        <div class="p-3 text-center">
                            {{ usePage().props.flash.info }}
                        </div>
                    </div>
                </div>
                <InnerSection>
                    <template #content>
                        <div class="grid xl:grid-cols-3 xl:gap-6">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="name" id="name" v-model="client.name"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " />
                                <label for="name"
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
                                    placeholder=" " />
                                <label for="email"
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
                                    placeholder=" " />
                                <label for="cpf"
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
                                    placeholder=" " />
                                <label for="cep"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    CEP
                                </label>
                                <div v-if="usePage().props.errors.cep" class="text-sm text-red-500">
                                    {{ usePage().props.errors.cep }}
                                </div>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="address" id="address" v-model="client.address"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-gray-900 dark:text-gray-100"
                                    placeholder=" " required />
                                <label for="address"
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
                                    placeholder=" " required />
                                <label for="phones"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Telefones
                                </label>
                                <div v-if="usePage().props.errors.phones" class="text-sm text-red-500">
                                    {{ usePage().props.errors.phones }}
                                </div>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <select name="branch_id" id="branch_id" v-model="client.branch_id"
                                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="" selected>selecione</option>
                                    <option v-for="branch in usePage().props.branches" :value="branch.id"
                                        :key="('branch' + branch.id)">
                                        {{ branch.name }}
                                    </option>
                                </select>
                                <label for="branch_id"
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
                                    placeholder=" " required />
                                <label for="notes"
                                    class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Observações
                                </label>
                                <div v-if="usePage().props.errors.notes" class="text-sm text-red-500">
                                    {{ usePage().props.errors.notes }}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" @click.prevent="client.reset()"
                                class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-800 focus:outline-none focus:shadow-outline">
                                Limpar
                            </button>
                            <button type="button" @click.prevent="createClient"
                                v-if="has(usePage().props.auth.permissions, ['Cliente Editar']) || has(usePage().props.auth.roles, ['Super Admin'])"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                                Criar Cliente
                            </button>
                        </div>
                    </template>
                </InnerSection>
            </template>
        </SubSection>

    </AuthenticatedLayout>
</template>
