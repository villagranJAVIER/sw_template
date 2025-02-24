<script setup>
import HeadLogo from '@/Components/HeadLogo.vue';
import HeroSection from './Partials/HeroSection.vue';
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
        <HeroSection>
            <template #title>
                "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
            </template>
            <template #description>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac mollis justo. Nullam eget lorem viverra,
                gravida magna sit amet, viverra mi. Aliquam erat volutpat. Mauris et quam a lectus venenatis malesuada
                quis a felis. Nulla facilisi. Aenean convallis eu ante at faucibus. Mauris dignissim mauris ut est
                scelerisque, et volutpat neque dapibus. Praesent nec dui condimentum, fermentum nulla vel, varius quam.
                Aliquam quis eros nec ligula feugiat suscipit. Quisque blandit lorem eu hendrerit fringilla. In mollis
                convallis venenatis. Morbi leo augue, maximus vel fringilla eu, ornare sed mauris. In vitae nulla vitae
                ex ultrices fermentum. Mauris lacinia dolor eget sollicitudin consequat.
            </template>
        </HeroSection>

    </LayoutWelcome>
</template>
