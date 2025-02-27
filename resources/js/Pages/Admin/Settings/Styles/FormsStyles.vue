<script setup>
import VueMultiselect from 'vue-multiselect';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { toast } from '@/toast'

const props = defineProps(['options']);

const stylesFormsStyles = useForm({
    text_light: usePage().props[1].stylesSettings.main.formsStyles[0],
    text_dark: usePage().props[1].stylesSettings.main.formsStyles[1],
    bg_light: usePage().props[1].stylesSettings.main.formsStyles[2],
    bg_dark: usePage().props[1].stylesSettings.main.formsStyles[3]
});

const stylesFormsStylesLight = computed(() =>
    'text-' + stylesFormsStyles.text_light
    + ' bg-' + stylesFormsStyles.bg_light
);

const stylesFormsStylesDark = computed(() =>
    ' text-' + stylesFormsStyles.text_dark
    + ' bg-' + stylesFormsStyles.bg_dark
);

function saveStyles() {
    stylesFormsStyles.put(route('settings.update.styles', 'formsStyles'), {
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
                toast.error('Foram encontrados erros ao processar sua solicitação');
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
                                    Estilos de <span class="italic underline">formsStyles</span>.
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    FormsStyles > Text > Light
                                </label>
                                <VueMultiselect v-model="stylesFormsStyles.text_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesFormsStyles.errors.text_light">
                                    {{ stylesFormsStyles.errors.text_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    FormsStyles > Background > Light
                                </label>
                                <VueMultiselect v-model="stylesFormsStyles.bg_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesFormsStyles.errors.bg_light">
                                    {{ stylesFormsStyles.errors.bg_light }}
                                </div>
                            </div>
                            <div class="md:col-span-2 p-1.5 border rounded-md">
                                Resultado:
                                <div
                                    :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.body[0] + ' bg-' + usePage().props[1].stylesSettings.main.body[2]">
                                    Body Light
                                    <div
                                        :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.container[0] + ' bg-' + usePage().props[1].stylesSettings.main.container[2]">
                                        Container Light
                                        <div
                                            :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.subSection[0] + ' bg-' + usePage().props[1].stylesSettings.main.subSection[2]">
                                            SubSection Light
                                            <div class="p-3 m-3 rounded-md w-auto" :class="stylesInnerSectionLight">
                                                InnerSection Light
                                                <input type="text" value="FormsStyles AaBbCc" id="" placeholder="FormsStyles AaBbCc"
                                                    class="w-full" :class="stylesFormsStylesLight">
                                            </div>
                                            <div class="p-3 m-3 rounded-md w-auto" :class="stylesInnerSectionLight">
                                                InnerSection Light
                                                <select type="text" name="" id="" class="w-full"
                                                    :class="stylesFormsStylesLight">
                                                    <option selected>FormsStyles AaBbCc</option>
                                                    <option>FormsStyles AaBbCc</option>
                                                    <option>FormsStyles AaBbCc</option>
                                                    <option>FormsStyles AaBbCc</option>
                                                </select>
                                            </div>
                                            <div class="p-3 m-3 rounded-md w-auto" :class="stylesInnerSectionLight">
                                                InnerSection Light
                                                <VueMultiselect :options="[]" :multiple="false" :close-on-select="true"
                                                    placeholder="Estilos não funcionam em VueMultiSelect"
                                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                                    :allow-empty="false" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group ml-0">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    FormsStyles > Text > Dark
                                </label>
                                <VueMultiselect v-model="stylesFormsStyles.text_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesFormsStyles.errors.text_dark">
                                    {{ stylesFormsStyles.errors.text_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    FormsStyles > Background > Dark
                                </label>
                                <VueMultiselect v-model="stylesFormsStyles.bg_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesFormsStyles.errors.bg_dark">
                                    {{ stylesFormsStyles.errors.bg_dark }}
                                </div>
                            </div>
                            <div class="md:col-span-2 p-1.5 border rounded-md">
                                Resultado: <div
                                    :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.body[1] + ' bg-' + usePage().props[1].stylesSettings.main.body[3]">
                                    Body Dark
                                    <div
                                        :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.container[1] + ' bg-' + usePage().props[1].stylesSettings.main.container[3]">
                                        Container Dark
                                        <div
                                            :class="'p-2 rounded-md w-auto text-' + usePage().props[1].stylesSettings.main.subSection[1] + ' bg-' + usePage().props[1].stylesSettings.main.subSection[3]">
                                            SubSection Dark
                                            <div class="p-3 m-3 rounded-md w-auto" :class="stylesInnerSectionDark">
                                                InnerSection Dark <br>
                                                <input type="text" value="FormsStyles AaBbCc" id="" placeholder="FormsStyles AaBbCc"
                                                    class="w-full" :class="stylesFormsStylesDark">
                                            </div>
                                            <div class="p-3 m-3 rounded-md w-auto" :class="stylesInnerSectionDark">
                                                InnerSection Dark <br>
                                                <select type="text" class="w-full"
                                                    :class="stylesFormsStylesDark">
                                                    <option selected>FormsStyles AaBbCc</option>
                                                    <option>FormsStyles AaBbCc</option>
                                                    <option>FormsStyles AaBbCc</option>
                                                    <option>FormsStyles AaBbCc</option>
                                                </select>
                                            </div>
                                            <div class="p-3 m-3 rounded-md w-auto" :class="stylesInnerSectionDark">
                                                InnerSection Dark
                                                <VueMultiselect :options="[]" :multiple="false" :close-on-select="true"
                                                    placeholder="Estilos não funcionam em VueMultiSelect"
                                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel=""
                                                    :allow-empty="false" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative m-4 p-3 w-full text-center">
                            <button type="button" @click.prevent="saveStyles('FormsStyles')"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                Salvar Estilos de <span class="italic underline">FormsStyles</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>