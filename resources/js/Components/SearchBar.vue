<template>
    <CardBox isForm @submit.prevent="$emit('applyFilters', true)" class="mb-2 p-2" has-border>
        <div class="flex flex-col gap-2 lg:flex-row">
            <div class="flex flex-col sm:flex-row gap-2 md:basis-4/5">
                <FormField class="order-2 sm:order-1" label="Número de registros">
                    <FormControl @change="$emit('applyFilters', true)" placeholder="Elige un número"
                        :options="rowsPerPage" v-model="rows" />
                </FormField>
                <FormField class="order-2 sm:order-1" v-if="hasPeriod" label="Mostrar desde">
                    <FormControl @change="$emit('applyFilters', true)" type="date" v-model="startDate" />
                </FormField>
                <FormField class="order-2 sm:order-1" v-if="hasPeriod" label="Hasta">
                    <FormControl @change="$emit('applyFilters', true)" type="date" v-model="endDate" />
                </FormField>
                <FormField class="order-1 sm:order-2 sm:grow" label="Búsqueda">
                    <FormControl type="search" ctrlKFocus :icon="mdiMagnify" v-model="search"
                        placeholder="Ingresa un parámetro de búsqueda" />
                </FormField>
            </div>

            <div class="flex gap-2 h-12 sm:justify-center md:basis-1/5 lg:justify-evenly lg:mt-7">
                <BaseButton @click="$emit('clearFilters')" class="grow" :icon="mdiBroom" color="danger"
                    label="Limpiar filtros" small />
                <BaseButton v-if="title" class="grow" :routeName="`${routeName}create`" :icon="mdiPlus" color="info"
                    :label="`Agregar ${title}`" small />
            </div>
        </div>

        <DropdownItem v-if="hasOtherFilters" v-model="showOtherFilters" class="mt-4 lg:mt-0">
            <template #header>Filtros avanzados</template>
            <div class="bg-slate-100 dark:bg-slate-900 p-5">
                <slot />
                <BaseButtons class="justify-center">
                    <BaseButton @click="$emit('applyFilters', true)" :icon="mdiMagnify" color="info"
                        label="Aplicar filtros" />
                </BaseButtons>
            </div>
        </DropdownItem>
    </CardBox>
</template>

<script setup>
import BaseButton from "@/Components/BaseButton.vue";
import CardBox from "@/Components/CardBox.vue";
import FormControl from "@/Components/FormControl.vue";
import FormField from "@/Components/FormField.vue";
import DropdownItem from "@/Components/DropdownItem.vue";
import {
    mdiBroom,
    mdiPlus,
    mdiCarSearch,
    mdiMagnify
} from "@mdi/js";
import { onMounted, ref, useSlots, watch } from "vue";
import BaseButtons from "./BaseButtons.vue";

const emits = defineEmits(['clearFilters', 'applyFilters']);
const slots = useSlots();

const props = defineProps({
    title: {
        type: String,
        required: false,
    },
    routeName: {
        type: String,
        required: true,
    },
    hasPeriod: Boolean,
});

const STORAGE_KEY = 'showOtherFilters'
const showOtherFilters = ref(true) // valor por defecto

const search = defineModel('search');
const rows = defineModel('rows');
const startDate = defineModel('startDate');
const endDate = defineModel('endDate');
const rowsPerPage = ["5", "10", "50"];

const hasOtherFilters = !!slots.default;

onMounted(() => {
    const saved = localStorage.getItem(STORAGE_KEY)
    if (saved !== null) {
        showOtherFilters.value = saved === 'true'
    }
});

watch(showOtherFilters, (newValue) => {
    localStorage.setItem(STORAGE_KEY, newValue)
});
</script>