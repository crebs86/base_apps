<script setup>

import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useToast } from "vue-toastification";
import moment from 'moment';
const toast = useToast();

const settings = useForm({
    canRegister: usePage().props.value.settings.canRegister[1],
    mustVerifyEmail: usePage().props.value.settings.mustVerifyEmail[1],
    logoutAfterChangeEmail: usePage().props.value.settings.logoutAfterChangeEmail[1],
    requireCpf: usePage().props.value.settings.requireCpf[1],
    saveUpdates_branches: usePage().props.value.settings.saveUpdates.branches[1],
    saveUpdates_clients: usePage().props.value.settings.saveUpdates.clients[1],
    saveUpdates_permissions: usePage().props.value.settings.saveUpdates.permissions[1],
    saveUpdates_roles: usePage().props.value.settings.saveUpdates.roles[1],
    saveUpdates_userRolesPermissions: usePage().props.value.settings.saveUpdates.userRolesPermissions[1],
    saveUpdates_users: usePage().props.value.settings.saveUpdates.users[1],
})

function saveSettings() {
    settings.put(route('settings.update', usePage().props.value.id), {
        onSuccess: () => {
            if (usePage().props.value.flash.success) {
                toast.success(usePage().props.value.flash.success);
            } else if (usePage().props.value.flash.error) {
                toast.error(usePage().props.value.flash.error);
            }

        },
        onError: () => {
            if (usePage().props.value.errors) {
                toast.error('Foram encontrado erros ao processar sua solicitação');
            }
        },
    })
}

</script>
<template>

    <Head title="Configurações" />

    <AuthenticatedLayout>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg font-bold text-center mb-2 text-gray-800 bg-gray-400 mx-1.5 rounded flex justify-center">
                Configurações
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-1 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                            <div class="grid cols-1">
                                <div v-if="usePage().props.value.errors.canRegister" class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.canRegister }}
                                </div>
                                <div v-if="usePage().props.value.errors.logoutAfterChangeEmail"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.logoutAfterChangeEmail }}
                                </div>
                                <div v-if="usePage().props.value.errors.requireCpf"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.requireCpf }}
                                </div>
                                <div v-if="usePage().props.value.errors.mustVerifyEmail" class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.mustVerifyEmail }}
                                </div>
                                <div v-if="usePage().props.value.errors.saveUpdates_branches"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.saveUpdates_branches }}
                                </div>
                                <div v-if="usePage().props.value.errors.saveUpdates_clients"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.saveUpdates_clients }}
                                </div>
                                <div v-if="usePage().props.value.errors.saveUpdates_permissions"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.saveUpdates_permissions }}
                                </div>
                                <div v-if="usePage().props.value.errors.saveUpdates_roles"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.saveUpdates_roles }}
                                </div>
                                <div v-if="usePage().props.value.errors.saveUpdates_userRolesPermissions"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.saveUpdates_userRolesPermissions }}
                                </div>
                                <div v-if="usePage().props.value.errors.saveUpdates_users"
                                    class="text-sm text-red-500">
                                    {{ usePage().props.value.errors.saveUpdates_users }}
                                </div>
                                <div class="flex w-full mb-5">
                                    <label for="canRegister" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="canRegister" class="sr-only"
                                                :checked="usePage().props.value.settings.canRegister[1]"
                                                v-model="settings.canRegister">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.canRegister[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5">
                                    <label for="mustVerifyEmail" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="mustVerifyEmail" class="sr-only"
                                                :checked="usePage().props.value.settings.mustVerifyEmail[1]"
                                                v-model="settings.mustVerifyEmail">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.mustVerifyEmail[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5">
                                    <label for="logoutAfterChangeEmail" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="logoutAfterChangeEmail" class="sr-only"
                                                :checked="usePage().props.value.settings.logoutAfterChangeEmail[1]"
                                                v-model="settings.logoutAfterChangeEmail">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.logoutAfterChangeEmail[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5">
                                    <label for="requireCpf" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="requireCpf" class="sr-only"
                                                :checked="usePage().props.value.settings.requireCpf[1]"
                                                v-model="settings.requireCpf">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.requireCpf[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-0.5">
                                    <label for="saveUpdates" class="flex items-center cursor-pointer">
                                        <div class="ml-2 dark:text-gray-300 font-bold">
                                            {{ usePage().props.value.settings.saveUpdates.title }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5 ml-5">
                                    <label for="saveUpdates_users" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="saveUpdates_users" class="sr-only"
                                                :checked="usePage().props.value.settings.saveUpdates.users[1]"
                                                v-model="settings.saveUpdates_users">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.saveUpdates.users[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5 ml-5">
                                    <label for="saveUpdates_clients" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="saveUpdates_clients" class="sr-only"
                                                :checked="usePage().props.value.settings.saveUpdates.clients[1]"
                                                v-model="settings.saveUpdates_clients">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.saveUpdates.clients[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5 ml-5">
                                    <label for="saveUpdates_branches" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="saveUpdates_branches" class="sr-only"
                                                :checked="usePage().props.value.settings.saveUpdates.branches[1]"
                                                v-model="settings.saveUpdates_branches">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.saveUpdates.branches[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5 ml-5">
                                    <label for="saveUpdates_permissions" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="saveUpdates_permissions" class="sr-only"
                                                :checked="usePage().props.value.settings.saveUpdates.permissions[1]"
                                                v-model="settings.saveUpdates_permissions">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.saveUpdates.permissions[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5 ml-5">
                                    <label for="saveUpdates_roles" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="saveUpdates_roles" class="sr-only"
                                                :checked="usePage().props.value.settings.saveUpdates.roles[1]"
                                                v-model="settings.saveUpdates_roles">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.saveUpdates.roles[0] }}
                                        </div>
                                    </label>
                                </div>

                                <div class="flex w-full mb-5 ml-5">
                                    <label for="saveUpdates_userRolesPermissions"
                                        class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="saveUpdates_userRolesPermissions" class="sr-only"
                                                :checked="usePage().props.value.settings.saveUpdates.userRolesPermissions[1]"
                                                v-model="settings.saveUpdates_userRolesPermissions">
                                            <div
                                                class="bg-teal-200 dark:bg-gray-500 w-10 h-4 rounded-full shadow-inner">
                                            </div>
                                            <div
                                                class="dot absolute w-6 h-4 bg-white rounded-full shadow -left-1 -top-0 transition">
                                            </div>
                                        </div>
                                        <div class="ml-3 dark:text-gray-300 font-medium">
                                            {{ usePage().props.value.settings.saveUpdates.userRolesPermissions[0] }}
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
                            Atualizado em {{ moment(usePage().props.value.updated_at).format('DD/MM/YYYY HH:mm:ss') }}
                        </p>
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