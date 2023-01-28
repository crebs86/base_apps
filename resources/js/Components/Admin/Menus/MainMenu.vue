<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue';
import hasPermission from '@/permissions'

const numberMenuItems = ref(2);
const classNumberMenuItems = ref('7');
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
    if (hasPermission(
        usePage().props.value.auth.permissions, ['Unidade Editar', 'Unidade Ver', 'Unidade Criar', 'Unidade Apagar']
    )
        || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])
    ) {
        numberMenuItems.value++
    }
    if (hasPermission(usePage().props.value.auth.roles, ['Super Admin'])
    ) {
        numberMenuItems.value++
        numberMenuItems.value++
    }
    classNumberMenuItems.value = numberMenuItems.value > 7 ? parseInt(numberMenuItems.value / 2) : numberMenuItems.value;
}
const showMenuItems = 'grid grid-cols-' + classNumberMenuItems.value;

</script>
<template>
    <div class="shadow-lg pb-1 rounded-b-3xl bg-teal-500 min-w-full md:min-w-[50%] lg:min-w-[35%] mx-auto">
        <div class="flex rounded-b-3xl bg-gray-100 dark:bg-gray-700 space-y-5 flex-col items-center text-[10px]">
            Olá, {{ usePage().props.value.auth.user.name }}!
        </div>
        <div class="px-2 py-1 items-center justify-around " :class="showMenuItems">
            <div class="flex flex-col items-center">
                <Link :href="route('dashboard')" :active="route().current('dashboard')"
                    class="text-teal-100 col-span-1 flex flex-col items-center max-w-max"
                    :class="route().current('dashboard') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="view-dashboard" title="Dashboard" class="h-6 w-6" />
                <span class="text-[9px] md:text-[14px] font-medium text-center">
                    Painel
                </span>
                </Link>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['ACL Editar', 'ACL Ver', 'ACL Criar', 'ACL Apagar', 'Usuario Editar', 'Usuario Ver', 'Usuario Criar', 'Usuario Apagar'])
            || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])" class="flex flex-col items-center">
                <Link :href="route('admin.acl.acl')" :active="route().current('admin.acl.*')"
                    class="text-teal-100 col-span-1 flex flex-col items-center max-w-max"
                    :class="route().current('admin.acl.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="shield-lock-outline" title="Controle de Acesso" class="h-6 w-6" />
                <span class="text-[9px] md:text-[14px] font-medium text-center">
                    Acesso
                </span>
                </Link>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['Cliente Editar', 'Cliente Ver', 'Cliente Criar', 'Cliente Apagar'])
            || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])" class="flex flex-col items-center">
                <Link :href="route('clients.index')" :active="route().current('clients.*')"
                    class="text-teal-100 col-span-1 flex flex-col items-center max-w-max"
                    :class="route().current('clients.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="account-heart" title="Clientes" class="h-6 w-6" />
                <span class="text-[9px] md:text-[14px] font-medium text-center">
                    Clientes
                </span>
                </Link>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['Unidade Editar', 'Unidade Ver', 'Unidade Criar', 'Unidade Apagar'])
            || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])" class="flex flex-col items-center">
                <Link :href="route('branches.index')" :active="route().current('branches.*')"
                    class="text-teal-100 col-span-1 flex flex-col items-center max-w-max"
                    :class="route().current('branches.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="source-branch" title="Unidades" class="h-6 w-6" />
                <span class="text-[9px] md:text-[14px] font-medium text-center">
                    Unidades
                </span>
                </Link>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                class="flex flex-col items-center">
                <Link :href="route('settings.index')" :active="route().current('settings.*')"
                    class="text-teal-100 col-span-1 flex flex-col items-center max-w-max"
                    :class="route().current('settings.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="cog" title="Configurações" class="h-6 w-6" />
                <span class="text-[9px] md:text-[14px] font-medium text-center">
                    Configurar
                </span>
                </Link>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                class="flex flex-col items-center">
                <Link :href="route('audit.index')" :active="route().current('audit.*')"
                    class="text-teal-100 col-span-1 flex flex-col items-center max-w-max"
                    :class="route().current('audit.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="lightbulb-on-outline" title="Auditar" class="h-6 w-6" />
                <span class="text-[9px] md:text-[14px] font-medium text-center">
                    Auditar
                </span>
                </Link>
            </div>
            <div class="flex flex-col items-center">
                <Link :href="route('user.account')" :active="route().current('admin.*')"
                    class="text-teal-100 col-span-1 flex flex-col items-center max-w-max"
                    :class="route().current('user.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="account" title="Minha Conta" class="h-6 w-6" />
                <span class="text-[9px] md:text-[14px] font-medium text-center">
                    Conta
                </span>
                </Link>
            </div>
        </div>
    </div>
</template>
