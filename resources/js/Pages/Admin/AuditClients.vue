<script setup>

import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuditClientsSearch from '@/Components/Admin/AuditClientsSearch.vue';

</script>
<template>

    <Head title="Auditar Clientes" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-800 dark:text-gray-300 py-3">
            <h1 class="text-lg font-bold text-center mb-2 text-gray-300 bg-gray-800 mx-1.5 rounded flex justify-center">
                Auditoria de Clientes
            </h1>
            <AuditClientsSearch :client="$page.props.client" :keyword="$page.props.keyword" />
        </div>
    </AuthenticatedLayout>
</template>