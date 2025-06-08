<script setup>
import SectionMain from "@/Components/SectionMain.vue";
import CardBox from "@/Components/CardBox.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiBallotOutline, mdiPencil, mdiCheckAll, mdiReplyAll, mdiViewModule } from "@mdi/js";
import SectionTitle from "@/Components/SectionTitle.vue";
import { defineProps, onMounted, watch } from 'vue';
import { Link } from "@inertiajs/vue3";
import JetLabel from "@/Components/Label.vue";
import JetInput from "@/Components/Input.vue";
import JetButton from "@/Components/Button.vue";
import Button from "@/Components/PrimaryButton.vue";

import JetInputError from "@/Components/InputError.vue";
import Pagination from "@/Shared/Pagination.vue";
import JetDangerButton from "@/Components/DangerButton.vue";

import { useForm } from "@inertiajs/vue3";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { computed, inject, reactive, ref, toRefs } from "vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import CardBoxComponentEmpty from "@/Components/CardBoxComponentEmpty.vue";

const { permissions, modules, form } = defineProps({
    permissions: {
        type: Object,
        required: true
    },
    modules: {
        type: Object,
        required: true
    },
    form: {
        type: Object,
        required: true
    }
});

const key = ref(null)
const inputSearchPermission = ref(null);
const permissionsFilter = ref([])

const searchPermission = () => {
    if (inputSearchPermission.value) {
        permissionsFilter.value[key.value] = permissions[key.value].filter(permission =>
            permission.name.toLowerCase().includes(inputSearchPermission.value.toLowerCase()) ||
            permission.description.toLowerCase().includes(inputSearchPermission.value.toLowerCase())
        );
    } else {
        permissionsFilter.value[key.value] = permissions[key.value];
    }
};

const checkedPermission = (permission) => {
    return form.permissions.includes(permission.id);
};

const togglePermission = (permission) => {
    const index = form.permissions.indexOf(permission.id);
    if (index === -1) {
        form.permissions.push(permission.id);
    } else {
        form.permissions.splice(index, 1);
    }
};

watch(() => key.value, () => {
    inputSearchPermission.value = null;
    searchPermission();
});

const addAllPermissions = () => {
    // Obtener todos los IDs de los permisos bajo la key seleccionada
    const permissionsToAdd = permissions[key.value].map(permission => permission.id);
    permissionsToAdd.forEach(permissionId => {
        if (!form.permissions.includes(permissionId)) {
            form.permissions.push(permissionId);
        }
    });
};

const removeAllPermissions = () => {
    const permissionsToRemove = permissions[key.value].map(permission => permission.id);
    form.permissions = form.permissions.filter(permissionId => !permissionsToRemove.includes(permissionId));
};

onMounted(() => {
    searchPermission()
});

</script>

<template>
    <CardBox>
        <div class="md:flex md:space-x-4 mb-5">
            <div class="md:w-1/2 max-lg:mb-5">
                <FormField label="Nombre del rol:" :required="true" :error="form.errors.name">
                    <FormControl v-model="form.name" placeholder="Nombre de rol" />
                </FormField>
            </div>

            <div class="md:w-1/2">
                <FormField label="Descripción:" :required="true" :error="form.errors.description">
                    <FormControl v-model="form.description" placeholder="Descripción" />
                </FormField>
            </div>
        </div>
    </CardBox>
    <div class="md:flex md:space-x-4 my-2">
        <CardBox class="md:w-5/12 p-2 max-lg:mb-5">
            <SectionTitleLineWithButton :icon="mdiViewModule" title="Módulos disponibles" />

            <div class="mt-4">
                <div class="flex flex-col space-y-2 overflow-y-auto h-96">
                    <a v-for="item in modules" :key="item.key" @click="key = item.key"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 cursor-pointer"
                        :class="{ 'active': item.key === key }" v-text="item.name" />
                </div>
            </div>
        </CardBox>
        <CardBox class="md:w-7/12 p-2">
            <SectionTitleLineWithButton :icon="mdiViewModule" title="Permisos disponibles" />
                    <BaseButtons type="justify-start" no-wrap>
                        <BaseButton color="contrast" :icon="mdiCheckAll" small label="TODOS"
                            @click="addAllPermissions()" />
                        <BaseButton color="contrast" :icon="mdiReplyAll" small label="NINGUNO"
                            @click="removeAllPermissions()" />
                    </BaseButtons>
                <div class="relative mt-5">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        id="search-module" v-model="inputSearchPermission" @keyup="searchPermission"
                        placeholder="Buscar permisos">
                    <button type="submit"
                        class="hidden md:inline-block text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        @click.prevent="searchPermission">
                        Buscar
                    </button>
                </div>
            <div class="mt-5">
                <div v-if="permissionsFilter?.[key]?.length > 0">
                    <div class="overflow-y-auto relative h-80">
    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 px-2">
        <li v-for="item in permissionsFilter[key]" :key="item.id" class="flex items-start">
            <label :for="'permission_' + item.id" class="flex items-start space-x-3 cursor-pointer w-full">
                <input
                    type="checkbox"
                    class="mt-1 accent-blue-600"
                    :id="'permission_' + item.id"
                    :value="{ id: item.id }"
                    :checked="checkedPermission(item)"
                    @change="togglePermission(item)"
                />
                <div class="text-sm text-gray-800 dark:text-gray-200">
                    <div class="font-semibold">{{ item.name }}</div>
                    <div class="text-gray-500 dark:text-gray-400 text-xs">{{ item.description }}</div>
                </div>
            </label>
        </li>
    </ul>
</div>

                </div>
                <CardBoxComponentEmpty v-else />
            </div>
        </CardBox>
    </div>
</template>

<style scoped>
.active {
    background-color: #1A56DB;
    color: white;
}
</style>