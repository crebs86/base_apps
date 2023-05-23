<script setup>
import { Link, Head, usePage } from '@inertiajs/vue3';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';

</script>
<template>
    <Head title="Usuários com Papél " + {{ $page.props.role.name }} />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <SubSection>
            <template #header>
                Lista de usuários com o papél: {{ $page.props.role.name }}
            </template>
            <template #content>
                <InnerSection>
                    <template #content>
                        <div class="pt-0.5" v-if="usePage().props.flash.info">
                            <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                                <div class="p-3 text-center">
                                    {{ usePage().props.flash.info }}
                                </div>
                            </div>
                        </div>
                        <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                            <table class="min-w-full mb-2 px-1">
                                <thead>
                                    <tr>
                                        <th v-for="(value, index) in ['ID', 'Nome', 'CPF', 'Ações']"
                                            :key="index + '' + value"
                                            class="px-3 py-1.5 md:px-6 md:py-3 bg-gray-100 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider dark:bg-gray-700 dark:text-gray-300">
                                            {{ value }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-600">
                                    <tr v-for="(v, i) in $page.props.users" :key="i">
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500"
                                            v-for="(value, index) in v" :key="i.id + '' + index">
                                            <div class="text-sm leading-5 text-blue-900 dark:text-gray-300">
                                                {{ value }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500 text-center">
                                            <div class="flex">
                                                <Link :href="route('admin.acl.users.roles.list', v.id)">
                                                <mdicon name="text-account" class="text-blue-600 hover:text-blue-300"
                                                    :title="'Editar papéis de ' + v.name" />
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>
                </InnerSection>
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>
<style scoped>
@media only screen and (max-height: 568px) {
    .permissions_content {
        height: 200px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 667px) {
    .permissions_content {
        height: 250px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 736px) {
    .permissions_content {
        height: 350px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 896px) {
    .permissions_content {
        height: 430px;
        overflow-y: scroll;
    }
}

@media only screen and (min-height: 897px) {
    .permissions_content {
        height: 440px;
        overflow-y: scroll;
    }
}
</style>