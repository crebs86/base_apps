<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/reactivity';
import { useToast } from "vue-toastification";

const toast = useToast();

const client = useForm({
    name: usePage().props.value.client.name,
    email: usePage().props.value.client.email,
    address: usePage().props.value.client.address,
    cpf: usePage().props.value.client.address,
    branch_id: usePage().props.value.client.branch_id
})

function saveClient() {
    client.put(route('clients.update', usePage().props.value.client.id), {
        onSuccess: (data) => toast.success(data.props.message),
        onError: (errors) => {
            toast.error('Erro ao salvar atualizações do cliente!')
            console.log(errors)
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
                                    <input type="text" name="name" id="name" v-model="client.name"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="name"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Nome
                                    </label>
                                    <div v-if="usePage().props.value.errors.name" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.name }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="email" name="email" id="email" v-model="client.email"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " :readonly="!usePage().props.value.edit" />
                                    <label for="email"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        E-mail
                                    </label>
                                    <div v-if="usePage().props.value.errors.email" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.email }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="cpf" id="cpf" :value="usePage().props.value.client.cpf"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " readonly />
                                    <label for="cpf"
                                        class="absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        CPF
                                    </label>
                                </div>
                            </div>

                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <textarea type="email" name="email" id="email" v-model="client.address"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required :readonly="!usePage().props.value.edit" />
                                    <label for="email"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Endereço
                                    </label>
                                    <div v-if="usePage().props.value.errors.address" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.address }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="branch" id="branch" :value="usePage().props.value.branch"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " readonly />
                                    <label for="branch"
                                        class="absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Unidade
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="saveClient"
                                    class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                    {{ usePage().props.value.edit ? 'Atualizar Cliente' : 'Habilitar Edição' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
