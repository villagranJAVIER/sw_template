<script setup>
import HeadLogo from '@/Components/HeadLogo.vue';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    title: {
        type: String,
        required: true
    }
});

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutWelcome>
        Welcome

    </LayoutWelcome>
</template>
