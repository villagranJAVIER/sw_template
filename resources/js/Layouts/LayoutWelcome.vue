<script setup>
import Container from './Partials/Container.vue';
import Footer from "./Partials/FooterGuest.vue";
import Navbar from "./Partials/Navbar.vue";
import { useStyleStore } from "@/stores/style.js";
const styleStore = useStyleStore();
</script>

<template>
  <!-- <div :class="{ dark: styleStore.darkMode }"> -->
  <div :class="{ dark: styleStore.darkMode }" >
    <Navbar />

    <Container bg="light">

      <slot class="min-h-screen" />
    </Container>

    <Footer />
  </div>
</template>