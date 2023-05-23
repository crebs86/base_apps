<script setup>
import VueMultiselect from 'vue-multiselect';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { toast } from '@/toast'

const props = defineProps(['options']);

const stylesContainer = useForm({
    text_light: usePage().props[1].stylesSettings.main.container[0],
    text_dark: usePage().props[1].stylesSettings.main.container[1],
    bg_light: usePage().props[1].stylesSettings.main.container[2],
    bg_dark: usePage().props[1].stylesSettings.main.container[3]
});

const stylesContainerLight = computed(() =>
    'text-' + stylesContainer.text_light
    + ' bg-' + stylesContainer.bg_light
);

const stylesContainerDark = computed(() =>
    ' text-' + stylesContainer.text_dark
    + ' bg-' + stylesContainer.bg_dark
);

function saveStyles(section) {
    stylesContainer.put(route('settings.update.styles', 'container'), {
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

</script>
<template>
    <div class="p-0 mt-2 dark:bg-gray-800 rounded-lg">
        <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
            <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 pt-1 rounded-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                    <div class="grid cols-1">
                        <div class="flex w-full mb-0.5">
                            <label for="saveUpdates" class="flex items-center cursor-pointer">
                                <div class="ml-2 dark:text-gray-300 font-bold">
                                    Estilos de <span class="italic underline">container</span>.
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Container > Text > Light
                                </label>
                                <VueMultiselect v-model="stylesContainer.text_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesContainer.errors.text_light">
                                    {{ stylesContainer.errors.text_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Container > Background > Light
                                </label>
                                <VueMultiselect v-model="stylesContainer.bg_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesContainer.errors.bg_light">
                                    {{ stylesContainer.errors.bg_light }}
                                </div>
                            </div>
                            <div class="md:col-span-2 p-1.5 border rounded-md">
                                Resultado:
                                <div
                                    :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.body[0] + ' bg-' + usePage().props[1].stylesSettings.main.body[2]">
                                    Body Light
                                    <div class="px-7 py-10 m-3 rounded-md w-auto" :class="stylesContainerLight">Container AaBbCc
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group ml-0">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Container > Text > Dark
                                </label>
                                <VueMultiselect v-model="stylesContainer.text_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesContainer.errors.text_dark">
                                    {{ stylesContainer.errors.text_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Container > Background > Dark
                                </label>
                                <VueMultiselect v-model="stylesContainer.bg_dark" :options="props.options" :multiple="false"
                                    :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                    selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesContainer.errors.bg_dark">
                                    {{ stylesContainer.errors.bg_dark }}
                                </div>
                            </div>
                            <div class="md:col-span-2 p-1.5 border rounded-md">
                                Resultado:
                                <div
                                    :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.body[1] + ' bg-' + usePage().props[1].stylesSettings.main.body[3]">
                                    Body Dark
                                    <div class="px-7 py-10 m-3 rounded-md w-auto" :class="stylesContainerDark">Container AaBbCc</div>
                                </div>
                            </div>
                        </div>
                        <div class="relative m-4 p-3 w-full text-center">
                            <button type="button" @click.prevent="saveStyles('container')"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                Salvar Estilos de <span class="italic underline">container</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>