<script setup>
import { computed, useSlots } from "vue";
import BaseIcon from "./BaseIcon.vue";
import { mdiHelpCircleOutline } from "@mdi/js";

defineProps({
  textClass: {
    type: String,
    default: 'text-base',
  },
  label: {
    type: String,
    default: null,
  },
  labelFor: {
    type: String,
    default: null,
  },
  help: {
    type: String,
    default: null,
  },
  error: {
    type: String,
    default: null,
  },
  required: {
    type: Boolean,
    default: false,
  },
});

const slots = useSlots();

const wrapperClass = computed(() => {
  const base = [];
  const slotsLength = slots.default().length;

  if (slotsLength > 1) {
    base.push("grid grid-cols-1 gap-3");
  }

  if (slotsLength === 2) {
    base.push("md:grid-cols-2");
  }

  return base;
});
</script>

<template>
  <div class="mb-6 last:mb-0">
    <label v-if="label" :for="labelFor" class="block font-bold mb-2" :class="textClass">
      <span v-if="required == true" class="text-red-600 mr-0">*</span>
      {{ label }}
    </label>
    <div :class="wrapperClass">
      <slot />
    </div>
    <div v-if="help && !error" class="flex items-center text-xs text-gray-500 dark:text-slate-400 mt-1">
      {{ help }}
      <BaseIcon :path="mdiHelpCircleOutline" size="15" />
    </div>
    <div v-if="error" class="text-sm text-red-600 mt-1">
      {{ error }}
    </div>
  </div>
</template>
