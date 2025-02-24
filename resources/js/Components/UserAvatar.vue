<script setup>
import { computed } from "vue";
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
  username: {
    type: String,
    required: true,
  },
  avatar: {
    type: String,
    default: null,
  },
  api: {
    type: String,
    default: "avataaars",
  },
});

const user = usePage().props.auth.user;

const avatar = computed(() => {
    if (user.file) {
        return user.file.path
    }
    return '/img/user.jpg'
});

const username = computed(() => props.username);
</script>

<template>
  <div>
    <img :src="avatar" :alt="username"
      class="rounded-full block h-auto w-full max-w-full bg-gray-100 dark:bg-slate-800" />
    <slot />
  </div>
</template>
