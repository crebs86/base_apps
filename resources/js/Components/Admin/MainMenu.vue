<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <div class="shadow-lg pb-1 rounded-b-3xl bg-teal-500">
        <div class="flex rounded-b-3xl bg-gray-100 dark:bg-gray-700 space-y-5 flex-col items-center py-1">
        </div>
        <div class="grid px-2 py-1 items-center justify-around grid-cols-3">
            <div class="col-span-1 flex flex-col items-center">
                <Link :href="route('dashboard')" :active="route().current('dashboard')"
                    :class="route().current('dashboard') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="view-dashboard" title="Dashboard" class="h-6 w-6" />
                </Link>
                <span class="text-[10.5px] font-medium text-center"
                    :class="route().current('dashboard') ? 'text-lime-300' : 'text-teal-100'">Painel</span>
            </div>
            <div class="col-span-1 flex flex-col items-center"
                :class="route().current('admin.acl.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('admin.acl.acl')" :active="route().current('admin.acl.*')">
                <mdicon name="shield-lock-outline" title="Controle de Acesso" class="h-6 w-6" />
                </Link>
                <span class="text-[10.5px] font-medium text-center"
                    :class="route().current('admin.acl.*') ? 'text-lime-300' : 'text-teal-100'">Acesso</span>
            </div>
            <div class="col-span-1 flex flex-col items-center text-teal-100 hover:text-emerald-400">
                <mdicon name="account-arrow-right" title="Controle de Acesso" class="h-6 w-6" />
                <span class="text-[10.5px] font-medium text-center text-teal-100">Sair</span>
            </div>
        </div>
    </div>
</template>