<script setup>
import { onMounted, ref } from 'vue';
import { toast } from '../../toast'
import { Link, Head, usePage } from '@inertiajs/vue3';
import AclMenu from '@/Components/Admin/Menus/AclMenu.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';
import SimpleModal from '@/Components/Common/SimpleModal.vue';
import axios from 'axios';
import { emittery } from '../../events';
import serialize from 'form-serialize';

onMounted(() => {
    emittery.on('getPermissionsListForm', async () => {
        getPermissionsListForm();
    })
})

const props = defineProps({
    rolesWithPermissions: Object,
    new: Boolean
})

const rolesWithPermissions = ref(props.rolesWithPermissions);

const permissionsList = ref({});
const newRole = ref('');
const message = ref({ mesage: '', code: 0 });

function saveNewRole() {
    if (newRole.value === '') {
        message.value = {
            message: 'Informe um nome para o novo papél!',
            code: 500
        };
    } else {

        let form = document.querySelector('#new_permissions_role');
        let values = serialize(form, { hash: true });
        axios.post(route('admin.acl.roles.new'),
            {
                name: newRole.value,
                permissions: values
            }
        ).then(r => {
            message.value = {
                message: r.data.message,
                code: r.status
            };

            rolesWithPermissions.value = r.data.rolesWithPermissions;

            form.reset();

        }).catch(e => {
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

function getPermissionsListForm() {
    axios.get(route('admin.acl.permissions.list.form'))
        .then(r => {
            permissionsList.value = r.data;
        }).catch(e => {
            toast.error('Erro ao buscar lista de permissões: ' + e.response.data.mesage)
        })

}

</script>
<template>
    <Head title="Papéis" />

    <AuthenticatedLayout>
        <template #inner_menu>
            <AclMenu />
        </template>
        <SubSection>
            <template #header>
                <SimpleModal :loadData="'getPermissionsListForm'" buttonTitle="Novo Papél"
                    :showOpenModalButton="$page.props.new">
                    <template #button_title>Papéis</template>
                    <template #title>Novo Papél</template>
                    <template #body>
                        <div class="grid gap-1">
                            <form>
                                <div>
                                    <div class="relative z-0 mb-6 w-full group">
                                        <input type="text" name="full_name" id="full_name" v-model="newRole"
                                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " />
                                        <label for="full_name"
                                            class="absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-first:left-1 peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nome do Papél
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
                            <div class="permissions_content grid justify-items-center">
                                Permissões do Novo Papel
                                <form id="new_permissions_role">
                                    <tr v-for="(v, i) in permissionsList" :key="i">
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                            <label :for="v.id">{{ v.name }}</label>
                                        </td>
                                        <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                            <input type="checkbox" :name="v.name" :value="v.name" :id="v.id"
                                                class="w-4 h-4 text-blue-600 bg-blue-200 rounded border-gray-300 focus:ring-green-500 focus:ring-2" />
                                        </td>
                                    </tr>
                                </form>
                            </div>
                        </div>
                    </template>
                    <template #button>
                        <button type="button" @click.prevent="saveNewRole"
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
                                    <th v-for="(value, index) in ['ID', 'Nome', 'Permissões', 'Ações']"
                                        :key="index + '' + value"
                                        class="px-3 py-1.5 md:px-6 md:py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-gray-200">
                                        {{ value }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, i) in rolesWithPermissions" :key="i"
                                    :class="i % 2 ? 'bg-slate-400 text-gray-100' : 'bg-slate-300 text-gray-700'">
                                    <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500"
                                        v-for="(value, index) in v" :key="i.id + '' + index">
                                        <template v-if="index === 'permissions'">
                                            <span v-for="(p, i) in v.permissions"
                                                class="relative inline-block px-2 py-0 font-semibold text-green-900 leading-tight m-0.5">
                                                <span aria-hidden
                                                    class="absolute inset-0 opacity-50 rounded-full bg-green-200 border border-green-600">
                                                </span>
                                                <span class="relative text-xs">
                                                    {{ p.name }}
                                                </span>
                                            </span>
                                        </template>
                                        <template v-else>
                                            <div class="text-sm leading-5">
                                                {{ value }}
                                            </div>
                                        </template>
                                    </td>
                                    <td class="px-3 py-1.5 md:px-6 md:py-3 whitespace-no-wrap border-b border-gray-500">
                                        <div class="grid grid-cols-2 gap-1">
                                            <Link :href="route('admin.acl.roles.show', v.id)">
                                            <mdicon name="playlist-edit" class="hover:text-yellow-200" title="Editar" />
                                            </Link>
                                            <Link :href="route('admin.acl.roles.list.users', v.id)">
                                            <mdicon name="text-account" class="hover:text-blue-300 dark:text-blue-400"
                                                :title="'Usuários com o papél: ' + v.name" />
                                            </Link>
                                        </div>
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