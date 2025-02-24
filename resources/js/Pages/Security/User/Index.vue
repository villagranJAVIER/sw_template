<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import {
    mdiBallotOutline,
    mdiInformation,
    mdiPencil,
    mdiBroom,
    mdiMagnify,
    mdiPlus
} from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import CardBoxComponentEmpty from "@/Components/CardBoxComponentEmpty.vue";
import { router, Head } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { reactive, ref, provide, watch } from "vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/css/index.css";
import { Inertia } from "@inertiajs/inertia";
import Dropdown from "@/Components/DropdownTable.vue";
import debounce from "lodash/debounce";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: "Index",
    title: {
        type: String,
        required: true,
    },
    users: {
        type: Object,
        default: () => ({}),
        required: true,
    },
    routeName: {
        type: String,
        required: true,
    },
    search: { type: String, required: true },
    direction: { type: String, required: true },
    profiles: {
        type: Object,
        default: {},
        required: true,
    },
    profile: {
        required: true,
    },
});

const search = ref(props.search);
const profile = ref(props.profile);
const isLoading = ref(false);
const state = reactive({
    filters: {
        search: search,
        order: props.users.order ?? "created_at",
        direction: props.direction,
        profile: profile ?? "",
    },
});

const filterSearch = () => {
    router.get(
        route(`${props.routeName}index`, state.filters, {
            replace: true,
        })
    );
};

const cleanFilters = () => {
    isLoading.value = true;
    router.get(route(`${props.routeName}index`));
};

const filterBy = (order, direction) => {
    state.filters.order = order;
    state.filters.direction = direction;
    isLoading.value = true;
    router.get(route(`${props.routeName}index`, state.filters));
};

const filtrar = () => {
    isLoading.value = true;
    router.get(route(`${props.routeName}index`, state.filters));
};

const opts = [
    {
        label: "Nombre",
        key: "name",
        menu: [
            { title: "Ordenar desde A - Z ", direction: "asc" },
            { title: "Ordenar desde Z - A ", direction: "desc" },
        ],
    },
    {
        label: "Email",
        key: "email",
        menu: [
            { title: "Ordenar desde A - Z ", direction: "asc" },
            { title: "Ordenar desde Z - A ", direction: "desc" },
        ],
    },
];

provide("filterBy", filterBy);

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiBallotOutline" :title="title" main>
        </SectionTitleLineWithButton>

        <NotificationBar v-if="$page.props.flash.success" color="success" :icon="mdiInformation" :outline="false">
            {{ $page.props.flash.success }}
        </NotificationBar>

        <NotificationBar v-if="$page.props.flash.error" color="danger" :icon="mdiInformation" :outline="false">
        </NotificationBar>

        <form @submit.prevent="filterSearch" class="w-full mb-5">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="flex w-full md:w-1/2 mr-1 my-4">
                    <input type="search" id="search-dropdown"
                        class="block pr-10 md:h-11 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-l-lg md:border-l-gray-300 border-l-gray-300 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Ingresa un parametro de busqueda" v-model="search" />
                    <BaseButton class="relative z-30 right-0 h-11 rounded-none" @click="filterSearch" :icon="mdiMagnify"
                        color="info" title="Buscar" />
                    <BaseButton class=" relative right-0 h-11 rounded-l-none rounded-r-lg" @click="cleanFilters"
                        :icon="mdiBroom" color="lightDark" title="Limpiar filtro" />
                </div>

                <BaseButtons>
                    <BaseButton :routeName="`${routeName}create`" color="info" :icon="mdiPlus" label="Agregar usuario"
                        class="w-full" />
                </BaseButtons>
            </div>
        </form>
        
        <CardBox v-if="users.data.length > 0">
            <table>
                <thead>
                    <tr>
                        <th />

                        <th>
                            <Dropdown title="Nombre" :options="opts" />
                        </th>
                        <th>
                            <Dropdown title="Email" :options="opts" />
                        </th>

                        <th class="text-left">
                            <span
                                class="inline-flex w-full gap-x-1.5 rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-md font-bold text-gray-900 dark:text-white ring-inset ring-gray-300 hover:bg-gray-100">
                                Rol
                            </span>
                        </th>

                        <th class="relative inline-block text-left">
                            <span
                                class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-md font-bold text-gray-900 dark:text-white ring-inset ring-gray-300 hover:bg-gray-100">
                                Acciones
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in users.data" :key="item.id">
                        <td class="align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-book-half" viewBox="0 0 16 16">
                                <path
                                    d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                            </svg>
                            <!-- <img :src="'/storage/photos/'+item.photo" alt=""> -->
                        </td>

                        <td data-label="Nombre">
                            {{ item.name }}
                        </td>
                        <td data-label="Email">
                            {{ item.email }}
                        </td>

                        <td data-label="Rol">
                            <ul class="list-disc list-inside">
                                <li v-for="(role, index) in item.roles" :key="index" class="text-xs">
                                    {{ role }}
                                </li>
                            </ul>
                        </td>

                        <td data-label="Acciones">
                            <div class="ml-10">
                                <BaseButton color="info" :icon="mdiPencil" small :routeName="`${routeName}edit`"
                                    :parameter="item.id" :title="'Editar (' + item.name + ')'" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </CardBox>
        <CardBoxComponentEmpty v-else />
        <pagination :links="users.links" :total="users.total" :to="users.to" :from="users.from" />
        <div class="vl-parent">
            <loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true" />
        </div>
    </LayoutMain>
</template>
