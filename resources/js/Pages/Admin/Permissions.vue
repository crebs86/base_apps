<script setup>
import { ref } from 'vue';
import { toast } from '../../toast'
import { Link, Head, usePage } from '@inertiajs/vue3';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SimpleModal from '@/Components/Common/SimpleModal.vue';
import axios from 'axios';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';

const props = defineProps({
    permissions: Object,
    new: Boolean
})

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

            newPermission.value = '';

        }).catch(e => {

            console.log(e)
            if (e.response.status === 403) {
                toast.error(e.response.data.message)
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
        <SubSection>
            <template #header>
                <SimpleModal buttonTitle="Nova Permissão" :showOpenModalButton="$page.props.new">
                    <template #button_title>Permissões</template>
                    <template #title>Nova Permissão</template>
                    <template #body>
                        <div class="grid gap-1">
                            <form id="new_permission">
                                <div>
                                    <div class="relative z-0 mb-6 w-full group">
                                        <input type="text" id="full_name" name="full_name" v-model="newPermission"
                                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " />
                                        <label for="full_name"
                                            class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-first:left-1 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
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
                            class="border border-green-600 bg-green-600 text-white hover:text-green-500 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-100 focus:outline-none focus:shadow-outline">
                            Salvar
                        </button>
                    </template>
                </SimpleModal>
            </template>
            <template #content>
                <div class="pt-0.5" v-if="usePage().props.flash.info">
                    <div class="max-w-lg bg-yellow-500 text-sm text-white rounded-md shadow-lg mx-auto my-2">
                        <div class="p-3 text-center">
                            {{ usePage().props.flash.info }}
                        </div>
                    </div>
                </div>
                <InnerSection>
                    <template #content>
                        <table class="min-w-full mb-2 px-1">
                            <thead>
                                <tr class="bg-slate-500">
                                    <th v-for="(value, index) in ['ID', 'Nome', 'Ações']" :key="index + '' + value"
                                        class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-200 tracking-wider">
                                        {{ value }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, i) in permissions" :key="i" :class="i%2 ? 'bg-slate-400 text-gray-100' : 'bg-slate-300 text-gray-700'">
                                    <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500"
                                        v-for="(value, index) in v" :key="i.id + '' + index">
                                        <template v-if="index === 'can'">
                                            <div class="flex text-sm leading-5">
                                                <Link v-if="value" class="text-center"
                                                    :href="route('admin.acl.permissions.edit', v.id)">
                                                <mdicon name="playlist-edit" class="justify-center"
                                                    :class="value ? 'hover:text-yellow-200' : ''"
                                                    title="Editar" />
                                                </Link>
                                                <Link :href="route('admin.acl.permissions.list.users', v.id)">
                                                <mdicon name="account-lock-open"
                                                    class=" hover:text-blue-300"
                                                    :title="'Usuários com a permissão: ' + v.name" />
                                                </Link>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <div class="text-sm leading-5">
                                                {{ value }}
                                            </div>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                </InnerSection>
            </template>
        </SubSection>
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