<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/reactivity';
import swal from 'sweetalert';
import { useToast } from "vue-toastification";

const toast = useToast();

const user = useForm({
    name: usePage().props.value.auth.user.name,
    email: usePage().props.value.auth.user.email
})
const password = useForm({
    current_password: '',
    password: '',
    password_confirmation: ''
})

const changeEmail = computed(() => {
    return usePage().props.value.auth.user.email !== user.email
})

function save() {
    user.post(route('user.account.update'), {
        onSuccess: (data) => toast.success(data.props.message),
        onError: (errors) => {
            toast.error('Erro ao salvar atualizações!')
        },
    })
}

function saveUser() {
    if (usePage().props.value.auth.user.email !== user.email) {
        swal({
            title: "Alteração de endereço de e-mail",
            text: "Você está alterando seu endereço de e-mail e sua validação poderá ser solicitada.",
            icon: "warning",
            buttons: ['Cancelar', 'Prosseguir'],
            dangerMode: true,
        })
            .then((willRestore) => {
                if (willRestore) {
                    save();
                }
            });
    } else {
        save();
    }
}

function updatePassword() {
    password.post(route('user.account.update.password'), {
        onSuccess: () => {
            if (usePage().props.value.flash.success) {
                toast.success(usePage().props.value.flash.success);
            } else if (usePage().props.value.flash.error) {
                toast.error(usePage().props.value.flash.error);
            }
        },
        onError: () => {
            if (usePage().props.value.errors) {
                toast.error('Erro ao alterar senha.');
            }
        },
    })
}

</script>

<template>

    <Head title="Minha Conta" />

    <AuthenticatedLayout>

        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg text-center mb-2 dark:text-gray-300">
                Dados da conta, {{ $page.props.auth.user.name }}
                <button type="button"
                    class="border rounded-md px-1 py-0.5 m-0.5 transition duration-500 ease select-none hover:bg-gray-300 focus:outline-none focus:shadow-outline">
                    <NavLink :href="route('logout')" method="post" :class="'text-gray-800 dark:text-white'">
                        Sair
                    </NavLink>
                </button>
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

                            <div class="grid xl:grid-cols-3 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="name" id="name" v-model="user.name"
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
                                    <input type="email" name="email" id="email" v-model="user.email"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="email"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        E-mail
                                    </label>
                                    <div v-if="usePage().props.value.errors.email" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.email }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="cpf" id="cpf" :value="usePage().props.value.auth.user.cpf"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " readonly />
                                    <label for="cpf"
                                        class="absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        CPF
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="saveUser"
                                    class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                    Atualizar Conta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-lg text-center my-2 dark:text-gray-300">
                Alterar senha
            </h1>
            <div class="p-0 mt-2 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">

                            <div class="grid xl:grid-cols-3 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="password" name="current_password" id="current_password"
                                        v-model="password.current_password"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="name"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Senha Atual
                                    </label>
                                    <div v-if="usePage().props.value.errors.current_password"
                                        class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.current_password }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="password" name="password" id="password" v-model="password.password"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="name"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Nova Senha
                                    </label>
                                    <div v-if="usePage().props.value.errors.password" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.password }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        v-model="password.password_confirmation"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="email"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Confirmar Nova Senha
                                    </label>
                                    <div v-if="usePage().props.value.errors.password_confirmation"
                                        class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.password_confirmation }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="updatePassword"
                                    class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                    Atualizar Senha
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
