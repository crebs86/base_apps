<script setup>
import { ref } from 'vue';
import { useToast } from "vue-toastification";
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AclUsersSearch from '@/Components/Admin/AclUsersSearch.vue';
import SubNavMenu from '@/Components/Admin/SubNavMenu.vue';

const props = defineProps({
    rolesWithPermissions: Object,
    users: Object,
    keyword: String
})

const toast = useToast();

const rolesWithPermissions = ref(props.rolesWithPermissions);

</script>
<template>

    <Head title="ACL Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl dark:text-gray-300 leading-tight">
                Controle de Acesso
            </h2>
        </template>
        <div class="py-1 mx-1 dark:bg-gray-800">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg dark:bg-gray-800 dark:shadow-gray-600">
                    <SubNavMenu />
                </div>
            </div>
        </div>
        <div class="py-6 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-600 p-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800 dark:text-gray-300">
                    <div class="py-6 px-1 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-500 dark:border-2 dark:shadow-dark-500 dark:shadow-xl">
                        <AclUsersSearch :users="$page.props.users" :keyword="$page.props.keyword"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>