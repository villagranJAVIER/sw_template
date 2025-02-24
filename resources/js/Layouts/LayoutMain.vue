<script setup>

import SectionMain from "@/Components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";


</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <slot />
        </SectionMain>
    </LayoutAuthenticated>
</template>
