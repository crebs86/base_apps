<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AclUsersSearch from '@/Components/Admin/AclUsersSearch.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';

const props = defineProps({
    rolesWithPermissions: Object,
    users: Object,
    keyword: String
})

const rolesWithPermissions = ref(props.rolesWithPermissions);

</script>
<template>
    <Head title="ACL Usuários" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <SubSection>
            <template #header>
                Usuários do Sistema
                <Link :href="route('admin.acl.users.create')" class="pl-1 ml-1">
                    <mdicon name="account-plus" title="Criar Cliente" class="justify-center" />
                </Link>
            </template>
            <template #content>
                <AclUsersSearch :users="$page.props.users" :keyword="$page.props.keyword" />
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>