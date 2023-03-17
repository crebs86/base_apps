<script setup>
import CustomBackgroundLayout from '@/Layouts/CustomBackgroundLayout.vue';
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
    <CustomBackgroundLayout :main_class="'background-image'" :slot_class="'slot_class text-white'"
        :logo_class="'text-gray-300 dark:text-red-300'">

        <Head title="Esqueci a senha" />

        <div class="mb-4 text-sm text-gray-100">
            Esqueseu sua senha? Só informar seu endereço de e-mail e você recebrá um link para definir uma nova senha de
            acesso.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-gray-300">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="E-mail" class="text-gray-300" />
                <TextInput id="email" type="email" class="mt-1 block w-full text-gray-300 bg-transparent" v-model="form.email"
                    required autofocus autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="border border-emerald-600 bg-emerald-500 text-white rounded-md px-4 py-3 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enviar link de redefinição de senha
                </PrimaryButton>
            </div>
        </form>
    </CustomBackgroundLayout>
</template>
