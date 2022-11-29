<script setup>
import { ref } from 'vue';
import { useToast } from "vue-toastification";
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import ClientsSearch from '@/Components/Admin/ClientsSearch.vue';

const props = defineProps({
    rolesWithPermissions: Object,
    clients: Object,
    keyword: String
})

const toast = useToast();

const rolesWithPermissions = ref(props.rolesWithPermissions);

</script>
<template>

    <Head title="ACL Usuários" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <ClientsSearch :clients="$page.props.clients" :keyword="$page.props.keyword" />
        </div>
    </AuthenticatedLayout>
</template>