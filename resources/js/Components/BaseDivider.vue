<script setup>
const props = defineProps({
  navBar: Boolean,
});
</script>

<template>
  <hr
    :class="
      props.navBar
        ? 'lg:my-0.5 dark:border-slate-700'
        : 'my-6 dark:border-slate-500 border-neutral-200'
    "
    class="border-t-2 border-gray-100"
  />
</template>
