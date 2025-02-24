<script setup>
defineProps({
  noPadding: Boolean,
});
</script>

<template>
  <div class="flex-1" :class="{ 'max-lg:p-2 p-4': !noPadding }">
    <slot />
  </div>
</template>
