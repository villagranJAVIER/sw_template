<script setup>
import { ref, computed } from 'vue';
import BaseIcon from "@/Components/BaseIcon.vue";

import {
    mdiArrowDown,
    mdiArrowUp
} from "@mdi/js";

const props = defineProps({
    value: {
        type: Boolean,
        default: true,
    }
})

const open = ref(props.value);
function invertState() {
    open.value = !open.value;
}
</script>
<template>
    <div class="lg:w-full text-[.85rem] lg:ml-0">
        <h1 @click="invertState" :class="{ 'font-bold': open }"
            class="cursor-pointer text-very-dark-grayish-blue hover:text-red my-3.5 flex items-center justify-between">
            <slot name="header"></slot>

            <BaseIcon :path="open ? mdiArrowDown : mdiArrowUp"/>
            <!-- <img :class="{ 'rotate-180': open }" src="/src/assets/images/icon-arrow-down.svg" alt="" /> -->
        </h1>
        <p v-if="open" class="lg:mr-0 lg:text-left text-dark-grayish-blue my-3.5">
            <slot></slot>
        </p>
        <hr class="border-light-grayish-blue my-3.5" />
    </div>
</template>
