<script setup>
import { computed } from "vue";
import { useStyleStore } from "@/stores/style";
import {
  gradientBgPurplePink,
  gradientBgDark,
  gradientBgPinkRed,
  gradientBgWhite,
  gradientBgLight
} from "@/colors";

const props = defineProps({
  bg: {
    type: String,
    required: true,
    validator: (value) => ["purplePink", "pinkRed", "white", 'light'].includes(value),
  },
});

const colorClass = computed(() => {
  if (useStyleStore().darkMode) {
    return gradientBgDark;
  }

  switch (props.bg) {
    case "purplePink":
      return gradientBgPurplePink; 
    //  return 'bg-[conic-gradient(at_bottom_left,_var(--tw-gradient-stops))] from-white via-sky-100 to-sky-100';
    case "pinkRed":
      return gradientBgPinkRed;
    case "white":
      return gradientBgWhite;
    case "light":
      return gradientBgLight;
  }

  return "";
});
</script>

<template>
  <div
    class="min-h-screen"
    :class="colorClass"
  >
    <slot  />
  </div>
</template>
