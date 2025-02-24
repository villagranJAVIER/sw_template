<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    links: {
        type: Array
    }
})
</script>

<template>
    <nav class="relative flex justify-center mt-5">
        <template v-for="link in links" :key="link.label">
            <Link preserve-scroll :href="link.url ? link.url : '#'" :class="{
                'inline-block text-black px-3 py-1 mr-1 dark:text-white rounded hover:bg-slate-200 dark:hover:bg-slate-600':
                    !link.active,
                'inline-block text-white px-3 py-1 mr-1 bg-blue-500 rounded':
                    link.active,
            }">
            <span v-html="link.label"></span>
            </Link>
        </template>
    </nav>
</template>

<!-- 

   <Link preserve-scroll :href="link.url ?? ''" v-html="link.label"
                class="flex items-center justify-center px-3 py-2 text-sm rounded-lg "
                :class="{ 'bg-gray-200 ': link.active, 'disabled text-gray-300': !link.url,  'hover:bg-gray-100': !link.active,  }" />
-->