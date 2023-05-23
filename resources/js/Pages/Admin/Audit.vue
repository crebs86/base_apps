<script setup>

import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SubSection from '@/Components/Admin/SubSection.vue';
import InnerSection from '@/Components/Admin/InnerSection.vue';


</script>
<template>
    <Head title="Auditoria" />

    <AuthenticatedLayout>
        <SubSection>
            <template #header>
                Auditoria
            </template>
            <template #content>
                <InnerSection>
                    <template #content>
                        <div class="overflow-x-auto">
                            <div class="px-2 py-1 items-center justfy-center justify-around grid grid-cols-3">
                                <div class="flex flex-col items-center py-12">
                                    <Link :href="route('audit.clients.index')"
                                        class="flex flex-col items-center max-w-fill"
                                        :class="$page.props.app.settingsStyles.main.innerSectionIcons">
                                    <mdicon name="account-heart-outline" title="Auditar Clientes" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Clientes
                                    </span>
                                    </Link>
                                </div>
                                <div class="flex flex-col items-center py-12">
                                    <Link :href="route('audit.branches.index')"
                                        class="col-span-1 flex flex-col items-center max-w-max"
                                        :class="$page.props.app.settingsStyles.main.innerSectionIcons">
                                    <mdicon name="source-branch" title="Auditar Unidades" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Unidades
                                    </span>
                                    </Link>
                                </div>
                                <div class="flex flex-col items-center py-12">
                                    <Link :href="route('audit.users.index')"
                                        class="col-span-1 flex flex-col items-center max-w-max"
                                        :class="$page.props.app.settingsStyles.main.innerSectionIcons">
                                    <mdicon name="account-group-outline" title="Auditar Usuários" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Usuários
                                    </span>
                                    </Link>
                                </div>

                                <div class="flex flex-col items-center pt-12 pb-24">
                                    <Link :href="route('audit.permissions.index')"
                                        class="flex flex-col items-center max-w-max"
                                        :class="$page.props.app.settingsStyles.main.innerSectionIcons">
                                    <mdicon name="key-arrow-right" title="Auditar Permissões" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Permissões
                                    </span>
                                    </Link>
                                </div>

                                <div class="flex flex-col items-center pt-12 pb-24">
                                    <Link :href="route('audit.roles.index')"
                                        class="flex flex-col items-center max-w-max"
                                        :class="$page.props.app.settingsStyles.main.innerSectionIcons">
                                    <mdicon name="key-chain" title="Auditar Papéis" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Papéis
                                    </span>
                                    </Link>
                                </div>

                                <div class="flex flex-col items-center pt-12 pb-24">
                                    <Link :href="route('audit.acl.index')"
                                        class="flex flex-col items-center max-w-max"
                                        :class="$page.props.app.settingsStyles.main.innerSectionIcons">
                                    <mdicon name="shield-lock" title="Auditar Controle de Acessos" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Controle de Acessos
                                    </span>
                                    </Link>
                                </div>

                                <div class="flex flex-col items-center pt-12 pb-24">
                                    <Link :href="route('audit.setting.index')"
                                        class="flex flex-col items-center max-w-max"
                                        :class="$page.props.app.settingsStyles.main.innerSectionIcons">
                                    <mdicon name="cog-outline" title="Auditar Controle de Acessos" size="36" />
                                    <span class="text-[9px] md:text-[14px] font-medium text-center">
                                        Configurações
                                    </span>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </template>
                </InnerSection>
            </template>
        </SubSection>
    </AuthenticatedLayout>
</template>
