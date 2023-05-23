<script setup>
import VueMultiselect from 'vue-multiselect';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { toast } from '@/toast'

const props = defineProps(['options']);

const stylesInnerSectionIcons = useForm({
    link_light: usePage().props[1].stylesSettings.main.innerSectionIcons[0],
    link_dark: usePage().props[1].stylesSettings.main.innerSectionIcons[1],
    linkHover_light: usePage().props[1].stylesSettings.main.innerSectionIcons[2],
    linkHover_dark: usePage().props[1].stylesSettings.main.innerSectionIcons[3]
});

const stylesInnerSectionIconsLight = computed(() =>
    'text-' + stylesInnerSectionIcons.link_light
    + ' hover:text-' + stylesInnerSectionIcons.linkHover_light
);

const stylesInnerSectionIconsDark = computed(() =>
    ' text-' + stylesInnerSectionIcons.link_dark
    + ' hover:text-' + stylesInnerSectionIcons.linkHover_dark
);

function saveStyles() {
    stylesInnerSectionIcons.put(route('settings.update.styles', 'innerSectionIcons'), {
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
                                    Estilos de <span class="italic underline">innerSectionIcons</span>.
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    InnerSectionIcons > Text > Light
                                </label>
                                <VueMultiselect v-model="stylesInnerSectionIcons.link_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesInnerSectionIcons.errors.link_light">
                                    {{ stylesInnerSectionIcons.errors.link_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    InnerSectionIcons > TextHover > Light
                                </label>
                                <VueMultiselect v-model="stylesInnerSectionIcons.linkHover_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600"
                                    v-if="stylesInnerSectionIcons.errors.linkHover_light">
                                    {{ stylesInnerSectionIcons.errors.linkHover_light }}
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
                                            <div class="p-3 m-3 rounded-md w-auto flex gap-2"
                                                :class="'text-' + usePage().props[1].stylesSettings.main.innerSection[0] + ' bg-' + usePage().props[1].stylesSettings.main.innerSection[2]">
                                                <a href="#" :class="stylesInnerSectionIconsLight">
                                                    <mdicon name="account-heart-outline" title="Icone"
                                                        size="36" />
                                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                        Clientes
                                                    </span>
                                                </a>
                                                <a href="#" :class="stylesInnerSectionIconsLight">
                                                    <mdicon name="content-save" title="Icone" size="36" />
                                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                        Salvar
                                                    </span>
                                                </a>
                                                <a href="#" :class="stylesInnerSectionIconsLight">
                                                    <mdicon name="account-cowboy-hat" title="Icone" size="36" />
                                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                        Cowboy
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group ml-0">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    InnerSectionIcons > Text > Dark
                                </label>
                                <VueMultiselect v-model="stylesInnerSectionIcons.link_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesInnerSectionIcons.errors.link_dark">
                                    {{ stylesInnerSectionIcons.errors.link_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    InnerSectionIcons > TextHover > Dark
                                </label>
                                <VueMultiselect v-model="stylesInnerSectionIcons.linkHover_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="stylesInnerSectionIcons.errors.linkHover_dark">
                                    {{ stylesInnerSectionIcons.errors.linkHover_dark }}
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
                                            <div class="p-3 m-3 rounded-md w-auto flex gap-2"
                                                :class="'text-' + usePage().props[1].stylesSettings.main.innerSection[1] + ' bg-' + usePage().props[1].stylesSettings.main.innerSection[3]">
                                                <a href="#" :class="stylesInnerSectionIconsDark">
                                                    <mdicon name="account-heart-outline" title="Icone"
                                                        size="36" />
                                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                        Clientes
                                                    </span>
                                                </a>
                                                <a href="#" :class="stylesInnerSectionIconsDark">
                                                    <mdicon name="content-save" title="Icone" size="36" />
                                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                        Salvar
                                                    </span>
                                                </a>
                                                <a href="#" :class="stylesInnerSectionIconsDark">
                                                    <mdicon name="account-cowboy-hat" title="Icone" size="36" />
                                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                        Cowboy
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative m-4 p-3 w-full text-center">
                            <button type="button" @click.prevent="saveStyles()"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                Salvar Estilos de <span class="italic underline">innerSectionIcons</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>