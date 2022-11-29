<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue';
import hasPermission from '@/permissions'

const numberMenuItems = ref(2);

onMounted: {
    if (hasPermission(
        usePage().props.value.auth.permissions, ['ACL Editar', 'ACL Ver', 'ACL Criar', 'ACL Apagar', 'Usuario Editar', 'Usuario Ver', 'Usuario Criar', 'Usuario Apagar']
    )
        || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])
    ) {
        numberMenuItems.value++
    }

    if (hasPermission(
        usePage().props.value.auth.permissions, ['Cliente Editar', 'Cliente Ver', 'Cliente Criar', 'Cliente Apagar']
    )
        || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])
    ) {
        numberMenuItems.value++
    }
}
const showMenuItems = 'grid grid-cols-' + numberMenuItems.value;

</script>
<template>
    <div class="shadow-lg pb-1 rounded-b-3xl bg-teal-500 min-w-full md:min-w-[50%] lg:min-w-[35%] mx-auto">
        <div class="flex rounded-b-3xl bg-gray-100 dark:bg-gray-700 space-y-5 flex-col items-center py-1">
        </div>
        <div class="px-2 py-1 items-center justify-around " :class="showMenuItems">
            <div class="col-span-1 flex flex-col items-center">
                <Link :href="route('dashboard')" :active="route().current('dashboard')"
                    :class="route().current('dashboard') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="view-dashboard" title="Dashboard" class="h-6 w-6" />
                </Link>
                <span class="text-[10.5px] font-medium text-center"
                    :class="route().current('dashboard') ? 'text-lime-300' : 'text-teal-100'">Painel</span>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['ACL Editar', 'ACL Ver', 'ACL Criar', 'ACL Apagar', 'Usuario Editar', 'Usuario Ver', 'Usuario Criar', 'Usuario Apagar'])
            || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                class="col-span-1 flex flex-col items-center"
                :class="route().current('admin.acl.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('admin.acl.acl')" :active="route().current('admin.acl.*')">
                <mdicon name="shield-lock-outline" title="Controle de Acesso" class="h-6 w-6" />
                </Link>
                <span class="text-[10.5px] font-medium text-center"
                    :class="route().current('admin.acl.*') ? 'text-lime-300' : 'text-teal-100'">Acesso</span>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['Cliente Editar', 'Cliente Ver', 'Cliente Criar', 'Cliente Apagar'])
            || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                class="col-span-1 flex flex-col items-center"
                :class="route().current('clients.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('clients.index')" :active="route().current('clients.index')">
                <mdicon name="shield-lock-outline" title="Clientes" class="h-6 w-6" />
                </Link>
                <span class="text-[10.5px] font-medium text-center"
                    :class="route().current('clients.*') ? 'text-lime-300' : 'text-teal-100'">Clientes</span>
            </div>
            <div class="col-span-1 flex flex-col items-center"
                :class="route().current('user.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('user.account')" :active="route().current('admin.*')">
                <mdicon name="account" title="Minha Conta" class="h-6 w-6" />
                </Link>
                <span class="text-[10.5px] font-medium text-center"
                    :class="route().current('user.*') ? 'text-lime-300' : 'text-teal-100'">Conta</span>
            </div>
        </div>
    </div>
</template>
<style scoped>
.grid-cols-1 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

.grid-cols-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
}

.grid-cols-3 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.grid-cols-4 {
    grid-template-columns: repeat(4, minmax(0, 1fr));
}

.grid-cols-5 {
    grid-template-columns: repeat(5, minmax(0, 1fr));
}

.grid-cols-6 {
    grid-template-columns: repeat(6, minmax(0, 1fr));
}

.grid-cols-7 {
    grid-template-columns: repeat(7, minmax(0, 1fr));
}
</style>