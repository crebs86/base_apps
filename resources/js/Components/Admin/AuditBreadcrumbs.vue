<template>
    <nav class="flex px-5 py-3 mx-2 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 justify-center mb-2"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <div class="flex items-center">
                    <slot name="home"></slot>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                    <span class="ml-1 text-md font-bold text-gray-400 md:ml-2 dark:text-gray-500">
                        <slot name="current"></slot>
                    </span>
                </div>
            </li>
        </ol>
    </nav>
</template>