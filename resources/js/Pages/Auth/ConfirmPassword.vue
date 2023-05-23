<script setup>
import CustomBackgroundLayout from '@/Layouts/CustomBackgroundLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
};
</script>

<template>
    <CustomBackgroundLayout :main_class="'background-image'" :slot_class="'slot_class text-white'"
        :logo_class="'text-gray-300 dark:text-red-300'">

        <Head title="Confirmar Senha" />

        <div class="mb-4 text-sm text-gray-100">
            Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Password" class="text-gray-100" />
                <TextInput id="password" type="password" class="mt-1 block w-full text-gray-300 bg-transparent"
                    v-model="form.password" required autocomplete="current-password" autofocus />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton
                    class="ml-4 border border-emerald-600 bg-emerald-500 text-white rounded-md px-4 py-3 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirmar
                </PrimaryButton>
            </div>
        </form>
    </CustomBackgroundLayout>
</template>
