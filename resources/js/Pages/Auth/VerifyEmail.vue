<script setup>
import { computed } from 'vue';
import CustomBackgroundLayout from '@/Layouts/CustomBackgroundLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <CustomBackgroundLayout :main_class="'background-image'" :slot_class="'slot_class text-white'"
        :logo_class="'text-gray-300 dark:text-red-300'">

        <Head title="Verificação de E-mail" />

        <div class="mb-4 text-sm text-gray-100">
            Antes de prosseguir você deverá validar seu e-mail através do link enviado para seu e-mail. Se você não recebeu o e-mail de confirmação clique no botão abaixo para enviarmos novamente.
        </div>

        <div class="mb-4 font-medium text-sm text-green-100" v-if="verificationLinkSent">
            Um novo link de verificação foi enviado para o endereço de e-mail informado no cadastro.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton
                    class="ml-4 border border-emerald-600 bg-emerald-500 text-white rounded-md px-4 py-3 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reenviar E-mail de Verificação
                </PrimaryButton>

                <Link :href="route('logout')" method="post" as="button"
                    class="underline text-sm text-gray-300 hover:text-gray-100">
                Sair</Link>
            </div>
        </form>
    </CustomBackgroundLayout>
</template>
