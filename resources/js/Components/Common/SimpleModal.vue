<script setup>
import { ref } from 'vue';
import { emittery } from '../../events'

const props = defineProps({
    loadData: String | null,
    buttonTitle: String,
    showOpenModalButton: Boolean
});

const showModal = ref(false);

function openModal(value) {
    if (value) {

        if (props.loadData !== undefined) {
            emittery.emit(props.loadData)
        }
        showModal.value = true
    } else {
        showModal.value = false
    }
}

</script>
<template>
    <div>
        <h2 class="flex justify-center text-lg dark:text-gray-300">
            <slot name="button_title"></slot>
            <mdicon v-if="showOpenModalButton" name="plus" @click="openModal(true)" style="cursor: pointer;"
                :title="buttonTitle">
            </mdicon>
        </h2>
        <div v-if="showModal"
            class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex pt-52 md:pt-0 ">
            <div class="relative my-6 mx-auto w-11/12 md:w-9/12 max-w-6xl h-5/6">
                <!--content-->
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full outline-none focus:outline-none"
                    :class="$page.props.app.settingsStyles.main.innerSection">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            <slot name="title"></slot>
                        </h3>
                        <button @click="openModal(false)"
                            class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
                            &cross;
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <slot name="body" class="my-4 text-slate-500 text-lg leading-relaxed"></slot>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                        <slot name="button"></slot>
                        <button type="button" @click="openModal(false)"
                            class="border border-red-500 bg-red-500 text-white hover:text-red-800 rounded-md px-4 py-2 m-2 transition duration-300 ease select-none hover:bg-red-200 focus:outline-none focus:shadow-outline">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>