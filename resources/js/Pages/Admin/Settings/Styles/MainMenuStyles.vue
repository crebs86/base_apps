<script setup>
import VueMultiselect from 'vue-multiselect';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { toast } from '@/toast'

const props = defineProps(['options']);

const MainMenuStyles = useForm({
    text_light: usePage().props[1].stylesSettings.mainMenu.icons[0],
    text_dark: usePage().props[1].stylesSettings.mainMenu.icons[1],
    hover_light: usePage().props[1].stylesSettings.mainMenu.icons[2],
    hover_dark: usePage().props[1].stylesSettings.mainMenu.icons[3],
    textActive_light: usePage().props[1].stylesSettings.mainMenu.iconsActive[0],
    textActive_dark: usePage().props[1].stylesSettings.mainMenu.iconsActive[1],
    textActive_hover_light: usePage().props[1].stylesSettings.mainMenu.iconsActive[2],
    textActive_hover_dark: usePage().props[1].stylesSettings.mainMenu.iconsActive[3],
    bg_light: usePage().props[1].stylesSettings.mainMenu.body[0],
    bg_dark: usePage().props[1].stylesSettings.mainMenu.body[1],
});

const MainMenuStylesLight = computed(() =>
    'text-' + MainMenuStyles.text_light
    + ' hover:text-' + MainMenuStyles.hover_light
);

const MainMenuStylesDark = computed(() =>
    ' text-' + MainMenuStyles.text_dark
    + ' hover:text-' + MainMenuStyles.hover_dark
);

const MainMenuActiveStylesLight = computed(() =>
    'text-' + MainMenuStyles.textActive_light
    + ' hover:text-' + MainMenuStyles.textActive_hover_light
);

const MainMenuActiveStylesDark = computed(() =>
    ' text-' + MainMenuStyles.textActive_dark
    + ' hover:text-' + MainMenuStyles.textActive_hover_dark
);

const MainMenuBodyLight = computed(() => 'bg-' + MainMenuStyles.bg_light);

const MainMenuBodyDark = computed(() => 'bg-' + MainMenuStyles.bg_dark);

function saveStyles() {
    MainMenuStyles.put(route('settings.update.styles', 'mainMenu'), {
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
                                    Estilos de <span class="italic underline">MainMenuStyles</span>.
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Text > Light
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.text_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.text_light">
                                    {{ MainMenuStyles.errors.text_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Hover > Light
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.hover_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.hover_light">
                                    {{ MainMenuStyles.errors.hover_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Text > Active > Light
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.textActive_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.textActive_light">
                                    {{ MainMenuStyles.errors.textActive_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Active > Hover > Light
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.textActive_hover_light" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.textActive_hover_light">
                                    {{ MainMenuStyles.errors.textActive_hover_light }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Body > Light
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.bg_light" :options="props.options" :multiple="false"
                                    :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                    selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.bg_light">
                                    {{ MainMenuStyles.errors.bg_light }}
                                </div>
                            </div>

                            <div class="md:col-span-2 p-1.5 border rounded-md">
                                Resultado:
                                <div class="shadow-lg pb-1 rounded-b-3xl min-w-full md:min-w-[50%] lg:min-w-[35%] mx-auto"
                                    :class="MainMenuBodyLight">
                                    <div
                                        class="flex rounded-b-3xl bg-gray-100 dark:bg-gray-700 space-y-5 flex-col items-center text-[10px]">
                                        Olá, {{ usePage().props.auth.user.name }}!
                                    </div>
                                    <div class="px-2 py-1 items-center justify-around grid grid-cols-3">
                                        <div class="flex flex-col items-center">
                                            <a href="#" class="col-span-1 flex flex-col items-center max-w-max"
                                                :class="MainMenuStylesLight">
                                                <mdicon name="view-dashboard" title="Dashboard" class="h-6 w-6" />
                                                <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                    Link
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <a href="#" class="col-span-1 flex flex-col items-center max-w-max"
                                                :class="MainMenuActiveStylesLight">
                                                <mdicon name="shield-lock-outline" title="Controle de Acesso"
                                                    class="h-6 w-6" />
                                                <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                    Link Ativo
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <a href="#" class="col-span-1 flex flex-col items-center max-w-max"
                                                :class="MainMenuStylesLight">
                                                <mdicon name="account-heart" title="Clientes" class="h-6 w-6" />
                                                <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                    Outro Link
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-1 p-1.5 my-0.5 border rounded-md">
                            <div class="relative mb-6 w-full group ml-0">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Text > Dark
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.text_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.text_dark">
                                    {{ MainMenuStyles.errors.text_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Hover > Dark
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.hover_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.hover_dark">
                                    {{ MainMenuStyles.errors.hover_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Text > Active > Dark
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.textActive_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.textActive_dark">
                                    {{ MainMenuStyles.errors.textActive_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Active > Hover > Dark
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.textActive_hover_dark" :options="props.options"
                                    :multiple="false" :close-on-select="true" placeholder="Classes tailwindcss"
                                    selectedLabel="Atual" selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.textActive_hover_dark">
                                    {{ MainMenuStyles.errors.textActive_hover_dark }}
                                </div>
                            </div>

                            <div class="relative mb-6 w-full group ml-0 md:ml-0.5">
                                <label class="text-sm text-yellow-800 font-bold dark:text-gray-100">
                                    MainMenuStyles > Body > Dark
                                </label>
                                <VueMultiselect v-model="MainMenuStyles.bg_dark" :options="props.options" :multiple="false"
                                    :close-on-select="true" placeholder="Classes tailwindcss" selectedLabel="Atual"
                                    selectLabel="Selecionar" deselectLabel="" :allow-empty="false" />
                                <div class="text-xs mx-1 text-red-600" v-if="MainMenuStyles.errors.bg_dark">
                                    {{ MainMenuStyles.errors.bg_dark }}
                                </div>
                            </div>

                            <div class="md:col-span-2 p-1.5 border rounded-md">
                                Resultado:
                                <div class="shadow-lg pb-1 rounded-b-3xl min-w-full md:min-w-[50%] lg:min-w-[35%] mx-auto"
                                    :class="MainMenuBodyDark">
                                    <div
                                        class="flex rounded-b-3xl bg-gray-100 dark:bg-gray-700 space-y-5 flex-col items-center text-[10px]">
                                        Olá, {{ usePage().props.auth.user.name }}!
                                    </div>
                                    <div class="px-2 py-1 items-center justify-around grid grid-cols-3">
                                        <div class="flex flex-col items-center">
                                            <a href="#" class="col-span-1 flex flex-col items-center max-w-max"
                                                :class="MainMenuStylesDark">
                                                <mdicon name="view-dashboard" title="Dashboard" class="h-6 w-6" />
                                                <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                    Link
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <a href="#" class="col-span-1 flex flex-col items-center max-w-max"
                                                :class="MainMenuActiveStylesDark">
                                                <mdicon name="shield-lock-outline" title="Controle de Acesso"
                                                    class="h-6 w-6" />
                                                <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                    Link Ativo
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <a href="#" class="col-span-1 flex flex-col items-center max-w-max"
                                                :class="MainMenuStylesDark">
                                                <mdicon name="account-heart" title="Clientes" class="h-6 w-6" />
                                                <span class="text-[9px] md:text-[14px] font-medium text-center">
                                                    Outro Link
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative m-4 p-3 w-full text-center">
                            <button type="button" @click.prevent="saveStyles()"
                                class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                Salvar Estilos de <span class="italic underline">MainMenuStyles</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>