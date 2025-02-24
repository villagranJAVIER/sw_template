<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { getButtonColor } from "@/colors.js";
import BaseIcon from "@/Components/BaseIcon.vue";

const props = defineProps({
  label: {
    type: [String, Number],
    default: null,
  },
  icon: {
    type: String,
    default: null,
  },
  iconSize: {
    type: [String, Number],
    default: null,
  },
  href: {
    type: String,
    default: null,
  },
  target: {
    type: String,
    default: null,
  },
  routeName: {
    type: String,
    default: null,
  },
  type: {
    type: String,
    default: null,
  },
  color: {
    type: String,
    default: "white",
  },
  iconColor: {
    type: String,
    default: "",
  },
  as: {
    type: String,
    default: null,
  },
  parameter: {
    type: [Number, Object, String],
    default: null,
  },
  roundedNone: Boolean,
  small: Boolean,
  outline: Boolean,
  active: Boolean,
  disabled: Boolean,
  roundedFull: Boolean,
  processing: Boolean,
});

const is = computed(() => {
  if (props.as) return props.as;
  if (props.routeName) return Link;
  if (props.href) return "a";
  return "button";
});

const computedType = computed(() => {
  if (is.value === "button") return props.type ?? "button";
  return null;
});

const labelClass = computed(() => props.small && props.icon ? "px-1" : "px-2");

const componentClass = computed(() => {
  const base = [
    "inline-flex", "justify-center", "items-center", "whitespace-nowrap",
    "focus:outline-none", "transition-colors", "focus:ring", "duration-150",
    "border", props.disabled || props.processing ? "cursor-not-allowed" : "cursor-pointer",
    props.roundedFull ? "rounded-full" : "rounded",
    getButtonColor(props.color, props.outline, !(props.disabled || props.processing), props.active),
  ];

  if (props.processing) {
    base.push("opacity-50");
  }

  if(props.roundedNone){
    base.push("rounded-none");

  }

  if (!props.label && props.icon) {
    base.push("p-1");
  } else if (props.small) {
    base.push("text-sm", props.roundedFull ? "px-3 py-1" : "p-1");
  } else {
    base.push("py-2", props.roundedFull ? "px-6" : "px-3");
  }

  if (props.disabled || props.processing) {
    base.push(props.outline ? "opacity-50" : "opacity-70");
  }

  return base;
});
</script>

<template>
  <component
    :is="is"
    :class="componentClass"
    :href="routeName ? route(routeName, parameter ?? null) : href"
    :type="computedType"
    :target="target"
    :disabled="props.disabled || props.processing">
    
    <BaseIcon v-if="icon" :path="icon" :size="iconSize" :class="iconColor" />
    <span v-if="label" :class="labelClass">{{ label }}</span>
    
    <svg v-if="props.processing" class="animate-spin h-5 w-5 text-white ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
    </svg>
  </component>
</template>