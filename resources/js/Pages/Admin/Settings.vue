<script setup>

import { Head, usePage } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>
<template>

    <Head title="Unidades" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg font-bold text-center mb-2 text-gray-300 bg-gray-800 mx-1.5 rounded flex justify-center">
                Configurações
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-1 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                            Configurações
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>