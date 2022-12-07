<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

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
    <GuestLayout>

        <Head title="Verificação de E-mail" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-500">
            Antes de prosseguir você deverá validar seu e-mail através do link enviado para seu e-mail. Se você não
            recebeu o e-mail de confirmação clique no botão abaixo para enviarmos novamente.
        </div>

        <div class="mb-4 font-medium text-sm text-green-600 dark:text-gray-500" v-if="verificationLinkSent">
            Um novo link de verificação foi enviado para o endereço de e-mail informado no cadastro.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton class="dark:bg-gray-300 hover:dark:bg-gray-500 dark:text-gray-600 hover:dark:text-gray-300" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reenviar E-mail de Verificação
                </PrimaryButton>

                <Link :href="route('logout')" method="post" as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 hover:dark:text-gray-200">Sair</Link>
            </div>
        </form>
    </GuestLayout>
</template>
