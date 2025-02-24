<script setup>
import Footer from "./Partials/FooterGuest.vue";
import Navbar from "./Partials/Navbar.vue";
import { useStyleStore } from "@/stores/style.js";
import { containerMaxW } from "@/config.js";

const styleStore = useStyleStore();
</script>

<template>
  <div :class="{ dark: styleStore.darkMode }">
    <Navbar />
    
    <div class="w-screen">
      <slot />
    </div>
    <Footer />

  </div>
</template>
