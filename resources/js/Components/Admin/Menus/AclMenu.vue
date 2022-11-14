<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <div
        class="grid rounded-2xl justify-evenly bg-teal-50 drop-shadow-md m-1 mt-0.5 grid-cols-3 py-1 dark:drop-shadow-xl dark:bg-gray-500 min-w-full md:min-w-[50%] lg:min-w-[35%] mx-auto">
        <div class="col-span-1 flex flex-col items-center">
            <Link :href="route('admin.acl.users.index')"
                :class="route().current('admin.acl.users.*') ? 'text-emerald-500 dark:text-lime-300' : 'text-gray-600 hover:text-emerald-600 dark:hover:text-lime-300'">
            <mdicon name="account-key" title="Usuários do Sistema" />
            </Link>
            <span class="text-[10.5px] font-bold text-center"
                :class="route().current('admin.acl.users.*') ? 'text-emerald-500 dark:text-lime-300' : 'text-gray-600'">Usuários</span>
        </div>
        <div class="col-span-1 flex flex-col items-center">
            <Link :href="route('admin.acl.roles.index')"
                :class="route().current('admin.acl.roles.*') ? 'text-emerald-500 dark:text-lime-300' : 'text-gray-600 hover:text-emerald-600 dark:hover:text-lime-300'">
            <mdicon name="key-chain" title="Papéis do Sistema" />
            </Link>
            <span class="text-[10.5px] font-bold text-center"
                :class="route().current('admin.acl.roles.*') ? 'text-emerald-500 dark:text-lime-300' : 'text-gray-600'">Papéis</span>
        </div>
        <div class="col-span-1 flex flex-col items-center">
            <Link :href="route('admin.acl.permissions.index')"
                :class="route().current('admin.acl.permissions.*') ? 'text-emerald-500 dark:text-lime-300' : 'text-gray-600 hover:text-emerald-600 dark:hover:text-lime-300'">
                <mdicon name="key-arrow-right" title="Permissões do Sistema" />
            </Link>
            <span class="text-[10.5px] font-bold text-center"
                :class="route().current('admin.acl.permissions.*') ? 'text-emerald-500 dark:text-lime-300' : 'text-gray-600'">Permissões</span>
        </div>
    </div>
</template>