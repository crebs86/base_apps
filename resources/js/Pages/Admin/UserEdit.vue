<script setup>
import { Head, usePage, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import moment from 'moment';
import swal from 'sweetalert';
import { useToast } from "vue-toastification";
import { Inertia } from '@inertiajs/inertia';
import VueMultiselect from 'vue-multiselect';

const props = defineProps({
    user: Object,
    branches: Object,
    _checker: String
});

const toast = useToast();

const options = props.branches;

const user = useForm({
    name: props.user.name,
    email: props.user.email,
    cpf: props.user.cpf,
    active: props.user.deleted_at === null,
    _checker: props._checker,
    branch_id: props.user.branch_id,
    notes: props.user.notes
})

const _branches = ref(props.user.branch_id);

function saveUser() {
    const pluck = (arr, key) => arr.map(i => i[key]);
    user.branch_id = pluck(_branches.value, 'id');
    user.put(route('admin.acl.users.update', props.user.id), {
        onSuccess: () => {
            if (usePage().props.value.flash.success) {
                toast.success(usePage().props.value.flash.success);
            } else if (usePage().props.value.flash.error) {
                toast.error(usePage().props.value.flash.error);
            }

        },
        onError: () => {
            if (usePage().props.value.errors) {
                toast.error('Foram encontrado erros ao processar sua solicitação');
            }
        },
    })
}

function userEmail(withoutCheck = false) {
    if (withoutCheck) {
        swal({
            title: "Validar e-mail?",
            text: "Deseja realmente validar o email " + props.user.email + " da conta de " + props.user.name,
            icon: "error",
            buttons: ['Cancelar', 'Validar'],
            dangerMode: true,
        })
            .then((verifyEmail) => {
                if (verifyEmail) {
                    Inertia.post(route('admin.acl.users.verify.email', props.user.id), { _checker: props._checker }, {
                        onSuccess: () => {
                            if (usePage().props.value.flash.success) {
                                toast.success(usePage().props.value.flash.success);
                            } else if (usePage().props.value.flash.error) {
                                toast.error(usePage().props.value.flash.error);
                            }

                        },
                        onError: () => {
                            if (usePage().props.value.errors) {
                                toast.error('Foram encontrado erros ao processar sua solicitação');
                            }
                        },
                    })
                }
            });
    } else {
        Inertia.post(route('admin.acl.users.require.email.verification', props.user.id), { _checker: props._checker }, {
            onSuccess: () => {
                if (usePage().props.value.flash.success) {
                    toast.success(usePage().props.value.flash.success);
                } else if (usePage().props.value.flash.error) {
                    toast.error(usePage().props.value.flash.error);
                }

            },
            onError: () => {
                if (usePage().props.value.errors) {
                    toast.error('Foram encontrado erros ao processar sua solicitação');
                }
            },
        })
    }
}

</script>
<template>

    <Head title="Editar usuário" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <div
            class="container mx-auto mt-1 text-justify px-0 md:px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">
            <h1 class="text-lg text-center mb-2 dark:text-gray-300">
                Editar Usuário: {{ props.user.name }}
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="pt-0.5" v-if="usePage().props.value.flash.info">
                    <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                        <div class="p-3 text-center">
                            {{ usePage().props.value.flash.info }}
                        </div>
                    </div>
                </div>
                <div class="mx-auto dark:bg-gray-800 p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">

                            <div class="grid xl:grid-cols-1 xl:gap-1">
                                <div class="relative z-1 mb-6 w-full group">
                                    <label class="text-sm text-gray-500 dark:text-gray-400">
                                        Unidades Vinculadas
                                    </label>
                                    <VueMultiselect v-model="_branches" :options="options" :multiple="true"
                                        :close-on-select="true" placeholder="Unidades Com Vínculo" label="name"
                                        track-by="name" selectLabel="Selecionar" deselectLabel="Remover" />

                                    <div v-if="usePage().props.value.errors.branch_id" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.branch_id }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="name" id="name" v-model="user.name"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="name"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Nome
                                    </label>
                                    <div v-if="usePage().props.value.errors.name" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.name }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="email" name="email" id="email" v-model="user.email"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="email"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        E-mail
                                    </label>
                                    <div v-if="usePage().props.value.errors.email" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.email }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" name="cpf" id="cpf" v-model="user.cpf"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="cpf"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        CPF
                                    </label>
                                    <div v-if="usePage().props.value.errors.cpf" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.cpf }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <textarea type="text" name="notes" id="notes" v-model="user.notes"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="notes"
                                        class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 text-gray-900 dark:text-gray-300">
                                        Observações
                                    </label>
                                    <div v-if="usePage().props.value.errors.notes" class="text-sm text-red-500">
                                        {{ usePage().props.value.errors.notes }}
                                    </div>
                                </div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="checkbox" name="active" id="active"
                                            class="form-checkbox h-5 w-5 text-gray-500" v-model="user.active"
                                            :checked="user.active">
                                        <span class="ml-2 text-gray-500 dark:text-gray-400">
                                            Ativo?
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" @click.prevent="saveUser"
                                    class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-lg text-center my-2 dark:text-gray-300">
                Situação do e-mail
            </h1>
            <div class="p-0 dark:bg-gray-800 rounded-lg">
                <div class="mx-auto dark:bg-gray-800 p-3 rounded-lg">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-1 md:px-8 pt-2.5 rounded-bl-lg rounded-br-lg dark:bg-gray-800 dark:text-gray-300">

                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <div class="relative z-0 mb-1 w-full group text-center">
                                    {{
                                        $page.props.user.email_verified_at ? 'Verificado em ' +
                                            moment($page.props.user.email_verified_at).format('DD/MM/YYYY HH:mm:ss')
                                            : ''
                                    }}
                                </div>
                                <div class="relative z-0 mb-3 w-full group text-center"
                                    v-if="!$page.props.user.email_verified_at">
                                    <button type="button" @click.prevent="userEmail(true)"
                                        class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                        Validar e-mail
                                    </button>
                                </div>
                                <div class="relative z-0 mb-3 w-full group text-center" v-else>
                                    <button type="button" @click.prevent="userEmail(false)"
                                        class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-300 focus:outline-none focus:shadow-outline">
                                        Exigir validação de endereço de e-mail.
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css">

</style>