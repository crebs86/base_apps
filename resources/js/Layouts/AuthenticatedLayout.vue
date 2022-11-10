<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import MainMenu from '@/Components/Admin/MainMenu.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);

</script>

<template>
    <div class="h-full flex flex-col bg-gray-100 dark:bg-gray-700 shadow-xl overflow-y-scroll mb-0.5 pb-4">
        <MainMenu />
        <!-- Page Content -->
        <div
            class="grid rounded-2xl justify-evenly bg-teal-50 drop-shadow-md dark:bg-gray-500 m-1 mt-0.5 grid-cols-4 py-1 dark:drop-shadow-xl">
            <div class="col-span-1 flex flex-col items-center">
                <span class="text-2xl font-bold dark:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400 dark:text-teal-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </span>
                <span class="text-[10.5px] font-medium text-center text-teal-400 dark:text-teal-100">Perfil</span>
            </div>
            <div class="col-span-1 flex flex-col items-center">
                <span class="text-2xl font-bold dark:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400 dark:text-teal-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </span>
                <span class="text-[10.5px] font-medium text-center text-teal-400 dark:text-teal-100">Perfil</span>
            </div>
            <div class="col-span-1 flex flex-col items-center">
                <span class="text-2xl font-bold dark:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400 dark:text-teal-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </span>
                <span class="text-[10.5px] font-medium text-center text-teal-400 dark:text-teal-100">Perfil</span>
            </div>
            <div class="col-span-1 flex flex-col items-center">
                <span class="text-2xl font-bold dark:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400 dark:text-teal-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </span>
                <span class="text-[10.5px] font-medium text-center text-teal-400 dark:text-teal-100">Perfil</span>
            </div>
        </div>

        <div class="container mx-auto mt-1 text-justify px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400">
            <main>
                <slot />
            </main>
        </div>
    </div>
        <footer class="p-4 bg-transparent rounded-lg shadow md:px-6 md:py-8 dark:bg-gray-700">
            <div class="sm:flex sm:items-center sm:justify-between">
                <!--a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0">
                <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a-->
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
            <span class="block text-sm sm:text-center dark:text-gray-300">© 2022-2022 Rodando com <a
                    href="https://crebs.dev"
                    class="text-blue-500 hover:text-blue-900 dark:hover:text-white">BaseApp</a>,
                desenvolvido por <a class="text-blue-500 hover:text-blue-900 dark:hover:text-white"
                    href="https://crebs.dev" target="_blank">CrebsDev</a>. Todos os direitos reservados.
            </span>
        </footer>
</template>
