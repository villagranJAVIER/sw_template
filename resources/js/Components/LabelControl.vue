<script setup>
import { computed } from 'vue';
import { defineComponent } from 'vue'
import { mdiContentCopy } from '@mdi/js';
import BaseButton from './BaseButton.vue';

const props = defineProps({
    value: {
        type: [String, Number, Array],
        default: null,
    },
    height: {
        type: String,
        default: 'h-12',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    canCopy: { type: Boolean, default: false, },
})

const labelClass = computed(() => {
    const base = [
        "shadow-none rounded-md px-2 py-2.5 border overflow-auto relative",
        props.disabled ?
            'bg-gray-300 text-slate-900 dark:bg-gray-600 dark:text-white border-gray-500 cursor-not-allowed' : 'border-gray-400 dark:border-gray-600 rounded dark:placeholder-gray-400 bg-white dark:bg-slate-800',
        props.height,
    ];
    return base;
});

const copyToClipboard = () => {
    if (!props.value) return;

    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(props.value);
    } else {
        const textarea = document.createElement("textarea");
        textarea.value = props.value;
        textarea.style.position = "absolute";
        textarea.style.opacity = "0";
        document.body.appendChild(textarea);
        textarea.select();
        document.body.removeChild(textarea);
    }
};

</script>

<template>
    <div :class="labelClass">
        {{ value }}
        <BaseButton
            v-if="canCopy"
            title="Copiar en el portapapeles"
            class="absolute top-1 right-1"
            color="transparent"
            :icon="mdiContentCopy"
            small
            @click="copyToClipboard"
        />
    </div>
</template>