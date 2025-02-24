<script setup>
import dataTable from './DataTable';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Tab, Tabs } from 'flowbite-vue';
import HeadLogo from '@/Components/HeadLogo.vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    }
});


const activeTab = ref('10 de Agosto');

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutWelcome>
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8">
            <div class="max-w-2xl lg:max-w-4xl mx-auto text-center mb-4">
                <h2 class="dark:text-blue-200 text-3xl sm:text-4xl font-semibold text-gray-900">
                    Team members
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
            </div>

            <Tabs v-model="activeTab" directive="show" variant="underline" class="p-5">
                <Tab v-for="tab in dataTable" :key="tab" :name="tab.name" :title="tab.name">
                    <div class="mt-4 shadow-sm border dark:border-blue-800 rounded-lg overflow-x-auto">
                        <table class="w-full table-auto text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-blue-900 font-medium border-b">
                                <tr class="dark:text-blue-200">
                                    <th class="py-3 px-6">Hora</th>
                                    <th class="py-3 px-6">Actividad</th>
                                    <th class="py-3 px-6">Lugar</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 divide-y">
                                <tr v-for="data in tab.dataTable" :key="data" class="dark:text-blue-100">
                                    <td data-label="Hora" class=" px-6 py-4 lg:w-40">
                                        {{ data.time }}
                                    </td>
                                    <td data-label="Actividad" class="px-6 py-4 lg:text-justify lg:w-[620px]">
                                        {{ data.activity }}
                                    </td>
                                    <td data-label="Lugar" class="px-6 py-4">
                                        {{ data.place }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </Tab>
            </Tabs>
        </div>
    </LayoutWelcome>
</template>