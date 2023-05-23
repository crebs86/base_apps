<script setup>

import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuditAclSearch from '@/Components/Admin/AuditAclSearch.vue';
import AuditBreadcrumbs from '@/Components/Admin/AuditBreadcrumbs.vue';
import SubSection from '@/Components/Admin/SubSection.vue';

</script>
<template>
    <Head title="Auditar Controle de Acesso" />
    <AuthenticatedLayout>
        <SubSection>
            <template #content>
                <AuditBreadcrumbs>
                    <template #home>
                        <Link :href="route('audit.index')" title="Auditoria"
                            class="ml-1 text-md font-bold text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-200 dark:hover:text-white">
                        Auditoria
                        </Link>
                    </template>
                    <template #current>
                        Controle de Acesso
                    </template>
                </AuditBreadcrumbs>
                <AuditAclSearch :user="$page.props.user" :keyword="$page.props.keyword" />
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>
