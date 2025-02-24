<template>
    <div>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li v-for="(tab, index) in tabTitle" :key="index" class="mr-2">
                    <button
                        @click="selectedTitle = tab"
                        :title="'Selecciona ' + tab"
                        :class="{
                            'border-b-green-500 border-b-4':
                                selectedTitle === tab,
                        }"
                        class="flex p-4 rounded-t-lg hover:text-gray-400 hover:border-green-400 dark:hover:text-gray-300"
                        id="dashboard-tab"
                        data-tabs-target="#dashboard"
                        type="button"
                        aria-selected="false"
                    >
                        {{ tab }}
                        <svg
                            v-if="error[index]"
                            xmlns="http://www.w3.org/2000/svg"
                            class="ml-1 icon icon-tabler icon-tabler-alert-circle"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="#ff2825"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 8v4" />
                            <path d="M12 16h.01" />
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
        <div>
            <slot />
        </div>
    </div>
</template>

<script>
import { mdiAlertCircleOutline } from "@mdi/js";
import { provide, ref } from "vue";
export default {
    setup(props, { slots }) {
        const tabTitle = ref(
            slots.default().map((tab) => {
                if (!tab.props.criteria) {
                    return tab.props.title;
                }
            })
        );
        const error = ref(
            slots.default().map((tab) => {
                if (!tab.props.criteria) {
                    return tab.props.error;
                }
            })
        );
        const selectedTitle = ref(tabTitle.value[0]);
        provide("selectedTitle", selectedTitle);
        return {
            tabTitle,
            selectedTitle,
            error,
        };
    },
};
</script>
