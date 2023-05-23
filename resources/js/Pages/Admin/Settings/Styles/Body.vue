<script setup>
import VueMultiselect from 'vue-multiselect';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { toast } from '@/toast'

const props = defineProps(['options']);

const stylesBody = useForm({
    text_light: usePage().props[1].stylesSettings.main.body[0],
    text_dark: usePage().props[1].stylesSettings.main.body[1],
    bg_light: usePage().props[1].stylesSettings.main.body[2],
    bg_dark: usePage().props[1].stylesSettings.main.body[3]
});

const stylesBodyLight = computed(() =>
    'text-' + stylesBody.text_light
    + ' bg-' + stylesBody.bg_light
);

const stylesBodyDark = computed(() =>
    ' text-' + stylesBody.text_dark
    + ' bg-' + stylesBody.bg_dark
);

function saveStyles(section) {
    stylesBody.put(route('settings.update.styles', 'body'), {
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

</script>
<template>
    <div class="p-0 dark:bg-gray-800 rounded-lg">
        <div class="mx-auto dark:bg-gray-800 p-0.5 md:p-3 rounded-lg">
            <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 pt-1 rounded-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">
                    <div class="grid cols-1">
                        <div class="flex w-full mb-0.5">
                            <label for="saveUpdates" class="flex items-center cursor-pointer">
                                <div class="ml-2 dark:text-gray-300 font-bold">
                                    Estilos de <span class="italic underline">body</span>.
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Body > Text > Light
                                </label>
                                <VueMultiselect v-model="stylesBody.text_light" :options="props.options" :multiple="false"
                                    :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                    selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesBody.errors.text_light">
                                    {{ stylesBody.errors.text_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Body > Background > Light
                                </label>
                                <VueMultiselect v-model="stylesBody.bg_light" :options="props.options" :multiple="false"
                                    :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                    selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesBody.errors.bg_light">
                                    {{ stylesBody.errors.bg_light }}
                                </div>
                            </div>
                            <div class="md:col-span-2 p-1.5 pb-3 border rounded-md">
                                Resultado:
                                <div class="p-7 m-3 rounded-md w-auto" :class="stylesBodyLight">Body Light AaBbCc</div>
                            </div>
                        </div>
                        <hr class="border-1 m-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative z-1 mb-6 w-full group ml-0">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Body > Text > Dark
                                </label>
                                <VueMultiselect v-model="stylesBody.text_dark" :options="props.options" :multiple="false"
                                    :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                    selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesBody.errors.text_dark">
                                    {{ stylesBody.errors.text_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    Body > Background > Dark
                                </label>
                                <VueMultiselect v-model="stylesBody.bg_dark" :options="props.options" :multiple="false"
                                    :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                    selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesBody.errors.bg_dark">
                                    {{ stylesBody.errors.bg_dark }}
                                </div>
                            </div>
                            <div class="md:col-span-2 p-1.5 pb-4 border rounded-md">
                                Resultado:
                                <div class="p-7 m-3 rounded-md w-auto" :class="stylesBodyDark">Body Dark AaBbCc</div>
                            </div>
                        </div>
                        <div class="relative m-4 p-3 w-full text-center">
                            <button type="button" @click.prevent="saveStyles('body')"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                Salvar Estilos de <span class="italic underline">body</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>