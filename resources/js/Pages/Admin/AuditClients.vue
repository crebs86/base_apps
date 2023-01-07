<script setup>

import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuditClientsSearch from '@/Components/Admin/AuditClientsSearch.vue';
import AuditBreadcrumbs from '@/Components/Admin/AuditBreadcrumbs.vue';

</script>
<template>

    <Head title="Auditar Clientes" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-800 dark:text-gray-300 py-3">

            <AuditBreadcrumbs>
                <template #home>
                    <Link :href="route('audit.index')" title="Auditoria"
                        class="ml-1 text-md font-bold text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-200 dark:hover:text-white">
                    Auditoria
                    </Link>
                </template>
                <template #current>
                    Cadastros de Clientes
                </template>
            </AuditBreadcrumbs>

            <AuditClientsSearch :client="$page.props.client" :keyword="$page.props.keyword" />
        </div>
    </AuthenticatedLayout>
</template>