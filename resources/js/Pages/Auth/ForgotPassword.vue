<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>

        <Head title="Esqueci a senha" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            Esqueseu sua senha? Só informar seu endereço de e-mail e você recebrá um link para definir uma nova senha de
            acesso.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-gray-300">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="E-mail" class="dark:text-gray-300" />
                <TextInput id="email" type="email" class="mt-1 block w-full dark:text-gray-600" v-model="form.email"
                    required autofocus autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="dark:bg-gray-300 hover:dark:bg-gray-500 dark:text-gray-600 hover:dark:text-gray-300" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
