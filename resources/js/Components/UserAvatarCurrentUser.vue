<script setup>
import UserAvatar from "@/Components/UserAvatar.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const userName = computed(() => usePage().props.auth.user.name);

</script>

<template>
  <UserAvatar :username="userName" api="initials">
    <slot />
  </UserAvatar>
</template>
