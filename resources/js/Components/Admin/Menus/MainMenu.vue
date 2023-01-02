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
        <div class="flex rounded-b-3xl bg-gray-100 dark:bg-gray-700 space-y-5 flex-col items-center">
            <small>Olá, {{ usePage().props.value.auth.user.name }}!</small>
        </div>
        <div class="px-2 py-1 items-center justify-around " :class="showMenuItems">
            <div class="col-span-1 flex flex-col items-center">
                <Link :href="route('dashboard')" :active="route().current('dashboard')"
                    :class="route().current('dashboard') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <mdicon name="view-dashboard" title="Dashboard" class="h-6 w-6" />
                </Link>
                <span class="text-[9px] md:text-[14px] font-medium text-center"
                    :class="route().current('dashboard') ? 'text-lime-300' : 'text-teal-100'">Painel</span>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['ACL Editar', 'ACL Ver', 'ACL Criar', 'ACL Apagar', 'Usuario Editar', 'Usuario Ver', 'Usuario Criar', 'Usuario Apagar'])
    || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])" class="col-span-1 flex flex-col items-center"
                :class="route().current('admin.acl.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('admin.acl.acl')" :active="route().current('admin.acl.*')">
                <mdicon name="shield-lock-outline" title="Controle de Acesso" class="h-6 w-6" />
                </Link>
                <span class="text-[9px] md:text-[14px] font-medium text-center"
                    :class="route().current('admin.acl.*') ? 'text-lime-300' : 'text-teal-100'">Acesso</span>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['Cliente Editar', 'Cliente Ver', 'Cliente Criar', 'Cliente Apagar'])
    || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])" class="col-span-1 flex flex-col items-center"
                :class="route().current('clients.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('clients.index')" :active="route().current('clients.index')">
                <mdicon name="account-heart" title="Clientes" class="h-6 w-6" />
                </Link>
                <span class="text-[9px] md:text-[14px] font-medium text-center"
                    :class="route().current('clients.*') ? 'text-lime-300' : 'text-teal-100'">Clientes</span>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.permissions, ['Unidade Editar', 'Unidade Ver', 'Unidade Criar', 'Unidade Apagar'])
    || hasPermission(usePage().props.value.auth.roles, ['Super Admin'])" class="col-span-1 flex flex-col items-center"
                :class="route().current('branches.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('branches.index')" :active="route().current('branches.*')">
                <mdicon name="source-branch" title="Unidades" class="h-6 w-6" />
                </Link>
                <span class="text-[9px] md:text-[14px] font-medium text-center"
                    :class="route().current('branches.*') ? 'text-lime-300' : 'text-teal-100'">Unidades</span>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                class="col-span-1 flex flex-col items-center"
                :class="route().current('settings.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('settings.index')" :active="route().current('settings.*')">
                <mdicon name="cog" title="Configurações" class="h-6 w-6" />
                </Link>
                <span class="text-[9px] md:text-[14px] font-medium text-center"
                    :class="route().current('settings.*') ? 'text-lime-300' : 'text-teal-100'">Configurar</span>
            </div>
            <div v-if="hasPermission(usePage().props.value.auth.roles, ['Super Admin'])"
                class="col-span-1 flex flex-col items-center"
                :class="route().current('audit.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('audit.index')" :active="route().current('audit.*')">
                <mdicon name="lightbulb-on-outline" title="Auditar" class="h-6 w-6" />
                </Link>
                <span class="text-[9px] md:text-[14px] font-medium text-center"
                    :class="route().current('audit.*') ? 'text-lime-300' : 'text-teal-100'">Auditar</span>
            </div>
            <div class="col-span-1 flex flex-col items-center"
                :class="route().current('user.*') ? 'text-lime-300' : 'text-teal-100 hover:text-emerald-400'">
                <Link :href="route('user.account')" :active="route().current('admin.*')">
                <mdicon name="account" title="Minha Conta" class="h-6 w-6" />
                </Link>
                <span class="text-[9px] md:text-[14px] font-medium text-center"
                    :class="route().current('user.*') ? 'text-lime-300' : 'text-teal-100'">Conta</span>
            </div>
        </div>
    </div>
</template>
