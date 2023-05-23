<script setup>
import CustomBackgroundLayout from '@/Layouts/CustomBackgroundLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <CustomBackgroundLayout :main_class="'background-image'" :slot_class="'slot_class text-white'"
        :logo_class="'text-gray-300 dark:text-red-300'">

        <Head title="Redefina Senha" />
        <h1 class="text-lg text-center mb-0.5 text-teal-900 mx-1.5 rounded-t-md">
            Redefinir Senha
        </h1>
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="E-mail" class="text-gray-100" />
                <TextInput id="email" type="email" class="mt-1 block w-full dark:text-gray-300 bg-transparent"
                    v-model="form.email" required autofocus autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Senha" class="text-gray-100" />
                <TextInput id="password" type="password" class="mt-1 block w-full dark:text-gray-300 bg-transparent"
                    v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirmar Senha" class="text-gray-100" />
                <TextInput id="password_confirmation" type="password"
                    class="mt-1 block w-full dark:text-gray-300 bg-transparent" v-model="form.password_confirmation"
                    required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="border border-emerald-600 bg-emerald-500 text-white rounded-md px-4 py-3 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Redefina a senha
                </PrimaryButton>
            </div>
        </form>
    </CustomBackgroundLayout>
</template>
