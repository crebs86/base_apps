<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
            <nav class="bg-white border-b border-gray-100 dark:bg-gray-600">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center h-16">
                        <div class="flex">
                            <!-- Logo
                            <div class="shrink-0 flex items-center left">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto dark:text-gray-300" />
                                </Link>
                            </div> -->

                            <!-- Navigation Links -->
                            <div class="shrink-0 flex items-center">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                                    :class="route().current('dashboard') ? 'text-green-600 border-green-600 dark:text-green-300 dark:border-green-300' : 'hover:text-gray-200'">
                                    <mdicon name="view-dashboard" title="Dashboard" />
                                </NavLink>
                            </div>

                            <div class="shrink-0 flex items-center">
                                <NavLink :href="route('admin.acl.acl')" :active="route().current('admin.acl.*')"
                                    :class="route().current('admin.acl.*') ? 'text-green-600 border-green-600 dark:text-green-300 dark:border-green-300' : 'hover:text-gray-200'">
                                    <mdicon name="shield-lock-outline" title="Controle de Acesso" />
                                </NavLink>
                            </div>
                            <!-- Settings Dropdown -->
                            <div class="shrink-0 flex items-center">
                                <Dropdown width="w-32">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 dark:bg-transparent">
                                                <mdicon name="account-arrow-right" />
                                            </button>
                                        </span>
                                    </template>
                                    <template #content>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Sair
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Heading -->
            <header class="bg-white shadow dark:bg-gray-600" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-1.5 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center">
                        <slot name="header" />
                    </div>
                </div>
            </header>
            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
