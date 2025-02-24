<script setup>
import { containerMaxW } from "@/config.js";

</script>

<template>
  <section class="p-1 md:p-6" :class="containerMaxW">
    <slot :class="containerMaxW"/>
  </section>
</template>
