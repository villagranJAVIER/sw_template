<template>
    <div class="flex flex-col md:flex-row items-center justify-between mt-6">
        <div class="mt-4 md:mt-0 md:pr-2 order-2">
            <ul class="pagination flex flex-wrap md:flex-nowrap">
                <li v-for="(link, key) in links" :class="estatus(link)" :key="key">
                    <Link v-if="clean(link.label) == 0" class="shadow-sm" :class="{
                        'inline-block rounded rounded-l-md text-sm px-4 py-2  text-black dark:text-white hover:bg-slate-200 dark:hover:bg-slate-700':
                            !link.active,
                        'inline-block rounded rounded-l-md text-sm px-4 py-2 text-black bg-gray-300 dark:bg-slate-600':
                            link.active,
                    }" @click="isLoading = true" :href="link.url ? link.url : '#'">
                    <span v-html="link.label"></span>
                    </Link>
                    <Link v-else :class="{
                        'inline-block rounded rounded-l-md text-sm px-2 py-2 text-black dark:text-white hover:bg-slate-200 dark:hover:bg-slate-600 opacity-50':
                            !link.url,
                        'inline-block rounded rounded-l-md text-sm px-2 py-2 text-black dark:text-white hover:bg-slate-200 dark:hover:bg-slate-600'
                            : link.url
                    }" @click="isLoading = true" :href="link.url ? link.url : '#'">
                    <span v-if="clean(link.label) === -1">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </span>

                    <span v-if="clean(link.label) === 1">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </span>
                    </Link>
                </li>
            </ul>
        </div>

        <div class="order-1 text-base">
            <span v-if="total > 0">
                Mostrando registros del {{ from }} al {{ to }} de un total de
                {{ total }} registros
            </span>
            <span v-else>Sin registros</span>
        </div>
    </div>
    <div class="vl-parent">
        <loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true" />
    </div>
</template>

<script>
import { useNFmt } from "@/Hooks/useFormato.js";
import { Link } from "@inertiajs/vue3";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/css/index.css";
import { ref } from "vue";

export default {
    props: {
        links: Array,
        total: Number,
        per_page: Number,
        from: Number,
        to: Number,
    },
    components: {
        Link,
        Loading,
    },
    setup() {
        const isLoading = ref(false);

        const link = ref(null);

        const clean = (label) => {
            if (label.includes("Anterior")) {
                return -1;
            } else if (label.includes("Siguiente")) {
                return 1;
            }
            return 0;
        };

        const estatus = (link) => {
            if (link.url === null) return "disabled";
            if (link.active) return "active";
        };
        return { useNFmt, estatus, clean, isLoading };
    },
};
</script>
