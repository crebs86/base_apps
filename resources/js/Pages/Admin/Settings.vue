<script setup>
import VueMultiselect from 'vue-multiselect';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BodyStyles from './Settings/Styles/Body.vue';
import ContainerStyles from './Settings/Styles/Container.vue';
import SubSectionStyles from './Settings/Styles/SubSection.vue';
import InnerSectionStyles from './Settings/Styles/InnerSection.vue';
import InnerSectionIconsStyles from './Settings/Styles/InnerSectionIcons.vue';
import MainMenuStyles from './Settings/Styles/MainMenuStyles.vue';
import { toast } from '@/toast'
import moment from 'moment';
import { computed } from 'vue';


const settings = useForm({
    canRegister: usePage().props[0].settings.canRegister[1],
    mustVerifyEmail: usePage().props[0].settings.mustVerifyEmail[1],
    logoutAfterChangeEmail: usePage().props[0].settings.logoutAfterChangeEmail[1],
    requireCpf: usePage().props[0].settings.requireCpf[1],
    saveUpdates_branches: usePage().props[0].settings.saveUpdates.branches[1],
    saveUpdates_clients: usePage().props[0].settings.saveUpdates.clients[1],
    saveUpdates_permissions: usePage().props[0].settings.saveUpdates.permissions[1],
    saveUpdates_roles: usePage().props[0].settings.saveUpdates.roles[1],
    saveUpdates_userRolesPermissions: usePage().props[0].settings.saveUpdates.userRolesPermissions[1],
    saveUpdates_users: usePage().props[0].settings.saveUpdates.users[1],
});

const stylesFooter = useForm({
    text_light: usePage().props[1].stylesSettings.main.footer[0],
    text_dark: usePage().props[1].stylesSettings.main.footer[1],
    bg_light: usePage().props[1].stylesSettings.main.footer[2],
    bg_dark: usePage().props[1].stylesSettings.main.footer[3],

    link_light: usePage().props[1].stylesSettings.main.footerLinks[0],
    link_dark: usePage().props[1].stylesSettings.main.footerLinks[1],
    linkHover_light: usePage().props[1].stylesSettings.main.footerLinks[2],
    linkHover_dark: usePage().props[1].stylesSettings.main.footerLinks[3]
});

const stylesFooterLight = computed(() =>
    'text-' + stylesFooter.text_light
    + ' bg-' + stylesFooter.bg_light
);

const stylesFooterDark = computed(() =>
    ' text-' + stylesFooter.text_dark
    + ' bg-' + stylesFooter.bg_dark
);

const stylesFooterLightLink = computed(() =>
    'text-' + stylesFooter.link_light
    + ' hover:text-' + stylesFooter.linkHover_light
);

const stylesFooterDarkLink = computed(() =>
    ' text-' + stylesFooter.link_dark
    + ' hover:text-' + stylesFooter.linkHover_dark
);

const textOptions = [
    'inherit',
    'current',
    'transparent',
    'black',
    'white',
    'slate-50',
    'slate-100',
    'slate-200',
    'slate-300',
    'slate-400',
    'slate-500',
    'slate-600',
    'slate-700',
    'slate-800',
    'slate-900',
    'gray-50',
    'gray-100',
    'gray-200',
    'gray-300',
    'gray-400',
    'gray-500',
    'gray-600',
    'gray-700',
    'gray-800',
    'gray-900',
    'zinc-50',
    'zinc-100',
    'zinc-200',
    'zinc-300',
    'zinc-400',
    'zinc-500',
    'zinc-600',
    'zinc-700',
    'zinc-800',
    'zinc-900',
    'neutral-50',
    'neutral-100',
    'neutral-200',
    'neutral-300',
    'neutral-400',
    'neutral-500',
    'neutral-600',
    'neutral-700',
    'neutral-800',
    'neutral-900',
    'stone-50',
    'stone-100',
    'stone-200',
    'stone-300',
    'stone-400',
    'stone-500',
    'stone-600',
    'stone-700',
    'stone-800',
    'stone-900',
    'red-50',
    'red-100',
    'red-200',
    'red-300',
    'red-400',
    'red-500',
    'red-600',
    'red-700',
    'red-800',
    'red-900',
    'orange-50',
    'orange-100',
    'orange-200',
    'orange-300',
    'orange-400',
    'orange-500',
    'orange-600',
    'orange-700',
    'orange-800',
    'orange-900',
    'amber-50',
    'amber-100',
    'amber-200',
    'amber-300',
    'amber-400',
    'amber-500',
    'amber-600',
    'amber-700',
    'amber-800',
    'amber-900',
    'yellow-50',
    'yellow-100',
    'yellow-200',
    'yellow-300',
    'yellow-400',
    'yellow-500',
    'yellow-600',
    'yellow-700',
    'yellow-800',
    'yellow-900',
    'lime-50',
    'lime-100',
    'lime-200',
    'lime-300',
    'lime-400',
    'lime-500',
    'lime-600',
    'lime-700',
    'lime-800',
    'lime-900',
    'green-50',
    'green-100',
    'green-200',
    'green-300',
    'green-400',
    'green-500',
    'green-600',
    'green-700',
    'green-800',
    'green-900',
    'emerald-50',
    'emerald-100',
    'emerald-200',
    'emerald-300',
    'emerald-400',
    'emerald-500',
    'emerald-600',
    'emerald-700',
    'emerald-800',
    'emerald-900',
    'teal-50',
    'teal-100',
    'teal-200',
    'teal-300',
    'teal-400',
    'teal-500',
    'teal-600',
    'teal-700',
    'teal-800',
    'teal-900',
    'cyan-50',
    'cyan-100',
    'cyan-200',
    'cyan-300',
    'cyan-400',
    'cyan-500',
    'cyan-600',
    'cyan-700',
    'cyan-800',
    'cyan-900',
    'sky-50',
    'sky-100',
    'sky-200',
    'sky-300',
    'sky-400',
    'sky-500',
    'sky-600',
    'sky-700',
    'sky-800',
    'sky-900',
    'blue-50',
    'blue-100',
    'blue-200',
    'blue-300',
    'blue-400',
    'blue-500',
    'blue-600',
    'blue-700',
    'blue-800',
    'blue-900',
    'indigo-50',
    'indigo-100',
    'indigo-200',
    'indigo-300',
    'indigo-400',
    'indigo-500',
    'indigo-600',
    'indigo-700',
    'indigo-800',
    'indigo-900',
    'violet-50',
    'violet-100',
    'violet-200',
    'violet-300',
    'violet-400',
    'violet-500',
    'violet-600',
    'violet-700',
    'violet-800',
    'violet-900',
    'purple-50',
    'purple-100',
    'purple-200',
    'purple-300',
    'purple-400',
    'purple-500',
    'purple-600',
    'purple-700',
    'purple-800',
    'purple-900',
    'fuchsia-50',
    'fuchsia-100',
    'fuchsia-200',
    'fuchsia-300',
    'fuchsia-400',
    'fuchsia-500',
    'fuchsia-600',
    'fuchsia-700',
    'fuchsia-800',
    'fuchsia-900',
    'pink-50',
    'pink-100',
    'pink-200',
    'pink-300',
    'pink-400',
    'pink-500',
    'pink-600',
    'pink-700',
    'pink-800',
    'pink-900',
    'rose-50',
    'rose-100',
    'rose-200',
    'rose-300',
    'rose-400',
    'rose-500',
    'rose-600',
    'rose-700',
    'rose-800',
    'rose-900'
];

function saveSettings() {
    settings.put(route('settings.update', usePage().props[0].id), {
        onSuccess: () => {
            if (usePage().props.flash.success) {
                toast.success(usePage().props.flash.success);
            } else if (usePage().props.flash.error) {
                toast.error(usePage().props.flash.error);
            }

        },
        onError: () => {
            if (usePage().props.errors) {
                toast.error('Foram encontrado erros ao processar sua solicitação');
            }
        },
        preserveScroll: true
    })
}

function saveStyles(section) {
if (section === 'footer') {
        stylesFooter.put(route('settings.update.styles', 'footer'), {
            onSuccess: () => {
                if (usePage().props.flash.success) {
                    toast.success(usePage().props.flash.success);
                } else if (usePage().props.flash.error) {
                    toast.error(usePage().props.flash.error);
                }

            },
            onError: () => {
                if (usePage().props.errors) {
                    console.log(usePage().props.errors)
                    toast.error('Foram encontrado erros ao processar sua solicitação');
                }
            },
            preserveScroll: true
        })
    }
}

</script>
<template>
    <Head title="Configurações" />

    <AuthenticatedLayout>

        <h1 class="text-lg font-bold text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded flex justify-center">
            Configurações
        </h1>
        <div class="p-0 dark:bg-gray-800 rounded-lg">
            <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
                <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-1 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                        <div class="grid cols-1">
                            <div v-if="usePage().props.errors.canRegister" class="text-sm text-red-500">
                                {{ usePage().props.errors.canRegister }}
                            </div>
                            <div v-if="usePage().props.errors.logoutAfterChangeEmail" class="text-sm text-red-500">
                                {{ usePage().props.errors.logoutAfterChangeEmail }}
                            </div>
                            <div v-if="usePage().props.errors.requireCpf" class="text-sm text-red-500">
                                {{ usePage().props.errors.requireCpf }}
                            </div>
                            <div v-if="usePage().props.errors.mustVerifyEmail" class="text-sm text-red-500">
                                {{ usePage().props.errors.mustVerifyEmail }}
                            </div>
                            <div v-if="usePage().props.errors.saveUpdates_branches" class="text-sm text-red-500">
                                {{ usePage().props.errors.saveUpdates_branches }}
                            </div>
                            <div v-if="usePage().props.errors.saveUpdates_clients" class="text-sm text-red-500">
                                {{ usePage().props.errors.saveUpdates_clients }}
                            </div>
                            <div v-if="usePage().props.errors.saveUpdates_permissions" class="text-sm text-red-500">
                                {{ usePage().props.errors.saveUpdates_permissions }}
                            </div>
                            <div v-if="usePage().props.errors.saveUpdates_roles" class="text-sm text-red-500">
                                {{ usePage().props.errors.saveUpdates_roles }}
                            </div>
                            <div v-if="usePage().props.errors.saveUpdates_userRolesPermissions"
                                class="text-sm text-red-500">
                                {{ usePage().props.errors.saveUpdates_userRolesPermissions }}
                            </div>
                            <div v-if="usePage().props.errors.saveUpdates_users" class="text-sm text-red-500">
                                {{ usePage().props.errors.saveUpdates_users }}
                            </div>
                            <div class="flex w-full mb-5">
                                <label for="canRegister" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="canRegister" class="sr-only"
                                            :checked="usePage().props[0].settings.canRegister[1]"
                                            v-model="settings.canRegister">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.canRegister[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5">
                                <label for="mustVerifyEmail" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="mustVerifyEmail" class="sr-only"
                                            :checked="usePage().props[0].settings.mustVerifyEmail[1]"
                                            v-model="settings.mustVerifyEmail">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.mustVerifyEmail[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5">
                                <label for="logoutAfterChangeEmail" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="logoutAfterChangeEmail" class="sr-only"
                                            :checked="usePage().props[0].settings.logoutAfterChangeEmail[1]"
                                            v-model="settings.logoutAfterChangeEmail">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.logoutAfterChangeEmail[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5">
                                <label for="requireCpf" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="requireCpf" class="sr-only"
                                            :checked="usePage().props[0].settings.requireCpf[1]"
                                            v-model="settings.requireCpf">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.requireCpf[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-0.5">
                                <label for="saveUpdates" class="flex items-center cursor-pointer">
                                    <div class="ml-2 dark:text-gray-300 font-bold">
                                        {{ usePage().props[0].settings.saveUpdates.title }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5 ml-5">
                                <label for="saveUpdates_users" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="saveUpdates_users" class="sr-only"
                                            :checked="usePage().props[0].settings.saveUpdates.users[1]"
                                            v-model="settings.saveUpdates_users">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.saveUpdates.users[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5 ml-5">
                                <label for="saveUpdates_clients" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="saveUpdates_clients" class="sr-only"
                                            :checked="usePage().props[0].settings.saveUpdates.clients[1]"
                                            v-model="settings.saveUpdates_clients">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.saveUpdates.clients[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5 ml-5">
                                <label for="saveUpdates_branches" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="saveUpdates_branches" class="sr-only"
                                            :checked="usePage().props[0].settings.saveUpdates.branches[1]"
                                            v-model="settings.saveUpdates_branches">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.saveUpdates.branches[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5 ml-5">
                                <label for="saveUpdates_permissions" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="saveUpdates_permissions" class="sr-only"
                                            :checked="usePage().props[0].settings.saveUpdates.permissions[1]"
                                            v-model="settings.saveUpdates_permissions">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.saveUpdates.permissions[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5 ml-5">
                                <label for="saveUpdates_roles" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="saveUpdates_roles" class="sr-only"
                                            :checked="usePage().props[0].settings.saveUpdates.roles[1]"
                                            v-model="settings.saveUpdates_roles">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.saveUpdates.roles[0] }}
                                    </div>
                                </label>
                            </div>

                            <div class="flex w-full mb-5 ml-5">
                                <label for="saveUpdates_userRolesPermissions" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" id="saveUpdates_userRolesPermissions" class="sr-only"
                                            :checked="usePage().props[0].settings.saveUpdates.userRolesPermissions[1]"
                                            v-model="settings.saveUpdates_userRolesPermissions">
                                        <div class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                        </div>
                                        <div
                                            class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                        </div>
                                    </div>
                                    <div class="ml-3 dark:text-gray-300 font-medium">
                                        {{ usePage().props[0].settings.saveUpdates.userRolesPermissions[0] }}
                                    </div>
                                </label>
                            </div>

                        </div>
                        <div class="relative z-0 mb-3 w-full">
                            <button type="button" @click.prevent="saveSettings"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                Salvar Configurações
                            </button>
                        </div>
                    </div>
                    <p class="mt-5">
                        Atualizado em {{ moment(usePage().props.updated_at).format('DD/MM/YYYY HH:mm:ss') }}
                    </p>
                </div>
            </div>
        </div>
        <h1 class="text-lg font-bold text-center my-2 text-gray-800 bg-gray-400 mx-1.5 rounded flex justify-center">
            Estilos
        </h1>

        <BodyStyles :options="textOptions"/>
        
        <ContainerStyles :options="textOptions"/>

        <SubSectionStyles :options="textOptions"/>

        <InnerSectionStyles :options="textOptions"/>

        <InnerSectionIconsStyles :options="textOptions"/>

        <MainMenuStyles :options="textOptions"/>


        <!-- Footer >> Rodapé -->
        <div class="p-0 mt-2 dark:bg-gray-800 rounded-lg">
            <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
                <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 pt-1 rounded-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                        <div class="grid cols-1">
                            <div class="flex w-full mb-0.5">
                                <label for="saveUpdates" class="flex items-center cursor-pointer">
                                    <div class="ml-2 dark:text-gray-300 font-bold">
                                        Estilos de <span class="italic underline">footer</span>.
                                    </div>
                                </label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                                <div class="relative mb-6 w-full group ml-0">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > Text > Light
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.text_light" :options="textOptions"
                                        :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                        selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                        :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.text_light">
                                        {{ stylesFooter.errors.text_light }}
                                    </div>
                                </div>

                                <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > Background > Light
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.bg_light" :options="textOptions" :multiple="false"
                                        :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                        selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.bg_light">
                                        {{ stylesFooter.errors.bg_light }}
                                    </div>
                                </div>
                                <div class="relative mb-6 w-full group ml-0">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > TextLink > Light
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.link_light" :options="textOptions"
                                        :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                        selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                        :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.link_light">
                                        {{ stylesFooter.errors.link_light }}
                                    </div>
                                </div>

                                <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > TextLinkHover > Light
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.linkHover_light" :options="textOptions"
                                        :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                        selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                        :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.linkHover_light">
                                        {{ stylesFooter.errors.linkHover_light }}
                                    </div>
                                </div>
                                <div class="md:col-span-2 p-1.5 border rounded-md">
                                    Resultado:
                                    <footer class="p-4 rounded-lg shadow md:px-6 md:py-8" :class="stylesFooterLight">
                                        <div class="sm:flex sm:items-center sm:justify-between">
                                        </div>
                                        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-800 lg:my-8">
                                        <span class="block text-sm sm:text-center">
                                            © 2022-{{ $page.props.app.year }} Rodando com <a href="https://crebs.dev"
                                                :class="stylesFooterLightLink">
                                                BaseApp v{{ $page.props.app.version }}
                                            </a>, desenvolvido por
                                            <a :class="stylesFooterLightLink" href="https://crebs.dev" target="_blank">
                                                CrebsDev
                                            </a>. Todos os direitos reservados.
                                        </span>
                                    </footer>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                                <div class="relative mb-6 w-full group ml-0">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > Text > Dark
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.text_dark" :options="textOptions"
                                        :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                        selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                        :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.text_dark">
                                        {{ stylesFooter.errors.text_dark }}
                                    </div>
                                </div>

                                <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > Background > Dark
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.bg_dark" :options="textOptions" :multiple="false"
                                        :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                        selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.bg_dark">
                                        {{ stylesFooter.errors.bg_dark }}
                                    </div>
                                </div>
                                <div class="relative mb-6 w-full group ml-0">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > TextLink > Dark
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.link_dark" :options="textOptions"
                                        :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                        selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                        :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.link_dark">
                                        {{ stylesFooter.errors.link_dark }}
                                    </div>
                                </div>

                                <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                    <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                        Footer > TextLinkHover > Dark
                                    </label>
                                    <VueMultiselect v-model="stylesFooter.linkHover_dark" :options="textOptions"
                                        :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                        selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                        :allow-empty="false" />
                                    <div class="text-xs mx-1 text-red-600" v-if="stylesFooter.errors.linkHover_dark">
                                        {{ stylesFooter.errors.linkHover_dark }}
                                    </div>
                                </div>
                                <div class="md:col-span-2 p-1.5 border rounded-md">
                                    Resultado:
                                    <footer class="p-4 rounded-lg shadow md:px-6 md:py-8" :class="stylesFooterDark">
                                        <div class="sm:flex sm:items-center sm:justify-between">
                                        </div>
                                        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-800 lg:my-8">
                                        <span class="block text-sm sm:text-center">
                                            © 2022-{{ $page.props.app.year }} Rodando com <a href="https://crebs.dev"
                                                :class="stylesFooterDarkLink">
                                                BaseApp v{{ $page.props.app.version }}
                                            </a>, desenvolvido por
                                            <a :class="stylesFooterDarkLink" href="https://crebs.dev" target="_blank">
                                                CrebsDev
                                            </a>. Todos os direitos reservados.
                                        </span>
                                    </footer>
                                </div>
                            </div>
                            <div class="relative mb-3 w-full text-center">
                                <button type="button" @click.prevent="saveStyles('footer')"
                                    class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                    Salvar Estilos de <span class="italic underline">footer</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
input:checked~.dot {
    transform: translateX(100%);
    background-color: #0ae465;
}
</style>