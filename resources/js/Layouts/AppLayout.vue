<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import HeadLogo from '@/Components/HeadLogo.vue';

defineProps({
    title: String,
});
</script>

<template>
    <div>
        <HeadLogo :title="title" />
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
