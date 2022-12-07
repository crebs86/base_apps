<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Novo Usuário" />

        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded">
                Novo Usuário
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">

                            <form @submit.prevent="submit">
                                <div>
                                    <InputLabel for="name" value="Nome" class="dark:text-gray-300" />
                                    <TextInput id="name" type="text" class="mt-1 block w-full dark:text-gray-600"
                                        v-model="form.name" required autofocus autocomplete="name" />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="email" value="E-mail" class="dark:text-gray-300" />
                                    <TextInput id="email" type="email" class="mt-1 block w-full dark:text-gray-600"
                                        v-model="form.email" required autocomplete="username" />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="password" value="Senha" class="dark:text-gray-300" />
                                    <TextInput id="password" type="password"
                                        class="mt-1 block w-full dark:text-gray-600" v-model="form.password" required
                                        autocomplete="new-password" />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="password_confirmation" value="Confirmar Senha"
                                        class="dark:text-gray-300" />
                                    <TextInput id="password_confirmation" type="password"
                                        class="mt-1 block w-full dark:text-gray-600"
                                        v-model="form.password_confirmation" required autocomplete="new-password" />
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <!-- <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                        Já é registrado?
                                    </Link> -->
                                    <button type="submit" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing"
                                        class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                                        Cadastrar Usuário
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
