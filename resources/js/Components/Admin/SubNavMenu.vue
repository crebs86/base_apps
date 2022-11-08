<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <div class="py-2 px-1 bg-white border-b border-gray-200 dark:bg-gray-600 dark:border dark:border-gray-600">
        <!-- ACL Tabs Start -->
        <div>
            <div class="mx-auto">
                <ul class="flex justify-center space-x-2 text-white dark:text-gray-300">
                    <li>
                        <Link :href="route('admin.acl.users.index')">
                        <button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none">
                            <mdicon name="account-key-outline" title="Usuários do Sistema" />
                        </button>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('admin.acl.roles.index')">
                        <button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none">
                            <mdicon name="key-chain" title="Permissões" />
                        </button>
                        </Link>
                    </li>
                    <li>
                        <button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none">
                            <mdicon name="key-arrow-right" title="Papéis" />
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ACL Tabs End -->
    </div>
</template>