<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    main_class: String,
    logo_class: String,
    slot_class: String
});

</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 dark:text-white" :class="main_class">
        <div>
            <Link href="/">
            <ApplicationLogo class="w-20 h-20 fill-current" :class="logo_class" />
            </Link>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg" :class="slot_class">
            <slot />
        </div>
    </div>
</template>
<style scoped>
.background-image {
    background: url('/backgrounds/aurora.jpg')no-repeat;
    background-position: center;
    background-size: cover;
}

.slot_class {
    border: 2px solid #036e5b80;
    border-radius: 20px;
    backdrop-filter: blur(28px);
}
</style>