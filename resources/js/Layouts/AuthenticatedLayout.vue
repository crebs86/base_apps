<script setup>
import MainMenu from '@/Components/Admin/Menus/MainMenu.vue';

</script>

<template>
    <div class="h-full flex flex-col bg-gray-100 dark:bg-gray-700 shadow-xl overflow-y-scroll mb-0.5 pb-4">
        <MainMenu />
        <!-- Page Content -->
        <slot name="inner_menu" />

        <slot />

    </div>
    <footer class="p-4 bg-transparent rounded-lg shadow md:px-6 md:py-8 dark:bg-gray-700">
        <div class="sm:flex sm:items-center sm:justify-between">
            <!--a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0">
                <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a-->
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-800 lg:my-8">
        <span class="block text-sm sm:text-center dark:text-gray-300">
            © {{ $page.props.app.year }}-2022 Rodando com <a href="https://crebs.dev"
                class="text-blue-500 hover:text-blue-900 dark:hover:text-white">
                BaseApp v{{ $page.props.app.version }}
            </a>, desenvolvido por
            <a class="text-blue-500 hover:text-blue-900 dark:hover:text-white" href="https://crebs.dev" target="_blank">
                CrebsDev
            </a>. Todos os direitos reservados.
        </span>
    </footer>
</template>