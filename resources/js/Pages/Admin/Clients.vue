<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ClientsSearch from '@/Components/Admin/ClientsSearch.vue';
import SubSection from '@/Components/Admin/SubSection.vue';

const props = defineProps({
    rolesWithPermissions: Object,
    clients: Object,
    keyword: String,
    includeTrash: Boolean
})

</script>
<template>
    <Head title="ACL Usuários" />

    <AuthenticatedLayout>
        <SubSection>
            <template #content>
                <ClientsSearch :clients="$page.props.clients" :keyword="$page.props.keyword" :includeTrash="includeTrash" />
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>