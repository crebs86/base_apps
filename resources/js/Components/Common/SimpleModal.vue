<template>
    <div class="p-3">
        <h2 class="flex justify-center text-blue-500 text-lg">
            <slot name="button_title"></slot>
            <mdicon name="plus" @click="openModal(true)" style="cursor: pointer;" title="Novo Papél"></mdicon>
        </h2>
    </div>

    <!-- overlay -->
    <div id="modal_overlay" :class="modal_overlay_classes" style="z-index: 100;"
        class="absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">

        <!-- modal -->
        <div id="modal" :class="modal_classes"
            class="transform relative w-10/12 md:w-1/2 h-1/2 md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

            <!-- button close -->
            <button @click="openModal(false)"
                class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
                &cross;
            </button>

            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-600">
                    <slot name="title"></slot>
                </h2>
            </div>

            <!-- body -->
            <div class="w-full p-3">
                <slot name="body"></slot>
            </div>

            <!-- footer -->
            <div
                class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                <slot name="button"></slot>
                <button type="button" @click="openModal(false)"
                    class="border border-red-500 bg-red-500 text-white hover:text-red-800 rounded-md px-4 py-2 m-2 transition duration-300 ease select-none hover:bg-red-200 focus:outline-none focus:shadow-outline">
                    Fechar
                </button>
            </div>
        </div>

    </div>
</template>
<script setup>
import { ref } from 'vue';

const modal_classes = ref(' opacity-0 -translate-y-full scale-150 ');
const modal_overlay_classes = ref('hidden');

function openModal(value) {

    if (value) {
        modal_overlay_classes.value = ' '
        setTimeout(() => {
            modal_classes.value = ' '
        }, 100);
    } else {
        modal_classes.value += ' -translate-y-full '
        setTimeout(() => {
            modal_classes.value += ' opacity-0 scale-150 '
        }, 100);
        setTimeout(() => modal_overlay_classes.value += ' hidden ', 300);
    }
}

</script>