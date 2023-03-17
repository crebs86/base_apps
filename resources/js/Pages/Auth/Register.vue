<script setup>
import CustomBackgroundLayout from '@/Layouts/CustomBackgroundLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';

defineProps({
    requireCpf: Boolean
});

const form = useForm({
    name: '',
    email: '',
    cpf: '',
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
    <CustomBackgroundLayout :main_class="'background-image'" :slot_class="'slot_class text-white'"
        :logo_class="'text-gray-300 dark:text-red-300'">

        <Head title="Novo Usuário" />

        <div class="container mx-auto text-justify px-0 md:px-2 rounded-lg dark:text-gray-400 py-2">
            <h1 class="text-lg text-center mb-0.5 text-teal-900 mx-1.5 rounded-t-md">
                Novo Usuário
            </h1>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Nome *" class="text-gray-100" />
                    <TextInput id="name" type="text" class="mt-1 block w-full text-gray-300 bg-transparent"
                        v-model="form.name" required autofocus autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="E-mail *" class="text-gray-100" />
                    <TextInput id="email" type="email" class="mt-1 block w-full dark:text-gray-300 bg-transparent"
                        v-model="form.email" required autocomplete="email" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="cpf" :value="requireCpf ? 'CPF *' : 'CPF'" class="text-gray-100" />
                    <TextInput id="cpf" type="text" class="mt-1 block w-full dark:text-gray-300 bg-transparent"
                        v-model="form.cpf" :required="requireCpf" autocomplete="cpf" />
                    <InputError class="mt-2" :message="form.errors.cpf" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Senha *" class="text-gray-100" />
                    <TextInput id="password" type="password" class="mt-1 block w-full dark:text-gray-300 bg-transparent"
                        v-model="form.password" required autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirmar Senha *" class="text-gray-100" />
                    <TextInput id="password_confirmation" type="password"
                        class="mt-1 block w-full dark:text-gray-300 bg-transparent" v-model="form.password_confirmation"
                        required autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <Link :href="route('login')" class="underline text-sm text-gray-300 hover:text-gray-900">
                Já é registrado?
                </Link>
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="border border-emerald-600 bg-emerald-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline">
                        Cadastrar Usuário
                    </button>
                </div>
            </form>
        </div>
    </CustomBackgroundLayout>
</template>
