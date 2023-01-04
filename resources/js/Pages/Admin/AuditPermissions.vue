<script setup>

import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuditPermissionsSearch from '@/Components/Admin/AuditPermissionsSearch.vue';

</script>
<template>

    <Head title="Auditar Permissões" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-800 dark:text-gray-300 py-3">
            <h1 class="text-lg font-bold text-center mb-2 text-gray-300 bg-gray-800 mx-1.5 rounded flex justify-center">
                Auditoria de Permissões
            </h1>
            <AuditPermissionsSearch :permission="$page.props.permission" :keyword="$page.props.keyword" />
        </div>
    </AuthenticatedLayout>
</template>
