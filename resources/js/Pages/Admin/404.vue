<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>

    <Head title="Página não encontrada" />

    <GuestLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-6 px-1 bg-yellow-200 rounded border border-orange-200">
                        <div>
                            <div class="container mx-auto">
                                <div class="mx-auto text-center bg-transparent dark:text-gray-700">
                                    Página não encontrada
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
