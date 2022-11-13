<script setup>
import { onMounted, ref } from 'vue';
import { useToast } from "vue-toastification";
import { Link, Head } from '@inertiajs/inertia-vue3';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SimpleModal from '@/Components/Common/SimpleModal.vue';
import axios from 'axios';
import { emittery } from '../../events';
import serialize from 'form-serialize';

const props = defineProps({
    permissions: Object,
    new: Boolean
})

const toast = useToast();

const permissions = ref(props.permissions);

const newPermission = ref('');
const message = ref({ mesage: '', code: 0 });

function saveNewPermission() {
    if (newPermission.value === '') {
        message.value = {
            message: 'Informe um nome para a nova permissão!',
            code: 500
        };
    } else {

        let form = document.querySelector('#new_permission');
        let values = serialize(form, { hash: true });
        axios.post(route('admin.acl.permissions.new'),
            {
                name: newPermission.value
            }
        ).then(r => {
            message.value = {
                message: r.data.message,
                code: r.status
            };

            permissions.value = r.data.permissions;

            form.reset();

        }).catch(e => {
            if (e.response.status === 403) {
                toast.error(e.response.data)
            } else {
                message.value = e.response;
                message.value = {
                    message: e.response.data.message,
                    code: e.response.status
                }
            }
        })
    }
}

</script>
<template>

    <Head title="Permissões" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <div
            class="container mx-auto mt-1 text-justify px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400 py-3">

            <SimpleModal buttonTitle="Nova Permissão" :showOpenModalButton="$page.props.new">
                <template #button_title>Permissões</template>
                <template #title>Nova Permissão</template>
                <template #body>
                    <div class="grid gap-1">
                        <form>
                            <div>
                                <div class="relative z-0 mb-6 w-full group">
                                    <input type="text" id="full_name" v-model="newPermission"
                                        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-grenn-400 appearance-none dark:border-gray-600 dark:focus:border-green-400 focus:outline-none focus:ring-0 focus:border-yellow-600 peer"
                                        required />
                                    <label for="full_name"
                                        class="absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-green-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 dark:text-gray-300">
                                        Nome da Permissão
                                    </label>
                                </div>
                            </div>
                        </form>
                        <div v-if="message?.message">
                            <div :class="message?.code === 200 && message?.code !== 0 ? 'bg-green-500' : 'bg-red-500'"
                                class="text-sm text-white rounded-md shadow-lg mx-auto py-2 px-1" role="alert">
                                <div class="flex p-3">
                                    {{ message?.message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template #button>
                    <button type="button" @click.prevent="saveNewPermission"
                        class="border border-green-600 bg-green-600 text-white hover:text-green-500 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 hover:bg-green-100 focus:outline-none focus:shadow-outline">
                        Salvar
                    </button>
                </template>
            </SimpleModal>
            <div class="py-0 px-0 dark:bg-gray-800">
                <div class="max-w-7xl mx-auto dark:bg-gray-600">
                    <div class="py-2 overflow-x-auto mt-2 bg-transparent">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg dark:bg-gray-600">
                            <table class="min-w-full mb-2 px-1">
                                <thead>
                                    <tr>
                                        <th v-for="(value, index) in ['ID', 'Nome', 'Ações']" :key="index + '' + value"
                                            class="bg-gray-100 px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider dark:bg-gray-700 dark:text-gray-300">
                                            {{ value }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-600">
                                    <tr v-for="(v, i) in permissions" :key="i">
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"
                                            v-for="(value, index) in v" :key="i.id + '' + index">
                                            <template v-if="index === 'can'">
                                                <div class="grid grid-cols-4 gap-6">
                                                    <Link v-if="value" :href="route('admin.acl.roles.show', v.id)">
                                                    <mdicon name="playlist-edit"
                                                        :class="value ? 'text-blue-600 hover:text-blue-300 dark:text-blue-400' : ''"
                                                        title="Editar" />
                                                    </Link>
                                                    <mdicon v-else name="playlist-remove"
                                                        :class="value ? 'text-blue-600 hover:text-blue-300 dark:text-blue-400' : ''"
                                                        title="Proibido Editar" />
                                                </div>
                                            </template>
                                            <template v-else>
                                                <div class="text-sm leading-5 text-blue-900 dark:text-gray-300">
                                                    {{ value }}
                                                </div>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
@media only screen and (max-height: 568px) {
    .permissions_content {
        height: 200px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 667px) {
    .permissions_content {
        height: 250px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 736px) {
    .permissions_content {
        height: 350px;
        overflow-y: scroll;
    }
}

@media only screen and (max-height: 896px) {
    .permissions_content {
        height: 430px;
        overflow-y: scroll;
    }
}

@media only screen and (min-height: 897px) {
    .permissions_content {
        height: 440px;
        overflow-y: scroll;
    }
}
</style>