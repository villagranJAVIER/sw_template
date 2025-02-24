<script setup>
import {
    mdiBallotOutline,
    mdiInformation,
    mdiPlus,
    mdiPencil,
    mdiMagnify,
} from "@mdi/js";
import CardBox from "@/Components/CardBox.vue";
import { defineProps, onMounted } from 'vue';
import JetInputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, inject, reactive, ref, watch } from "vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import "vue-select/dist/vue-select.css";
import BaseButton from "@/Components/BaseButton.vue";
import Select from '@/Components/Select.vue';
import axios from "axios";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const props = defineProps({
    name: 'DataForm',
    canEdit: { type: Boolean, default: false, required: false },
});

const form = inject("form");
const propsData = inject("propsData");
const isLoading = ref(false)

const checkedRole = (role) => {
    return form.roles.includes(role.id);
};

const toggleRole = (role) => {
    const index = form.roles.indexOf(role.id);
    if (index === -1) {
        form.roles.push(role.id);
    } else {
        form.roles.splice(index, 1);
    }
};


const getCurp = () => {
    isLoading.value = true;
    axios.get(route(`user.getCurp`, form.curp.toUpperCase()))
        .then((response) => {
            isLoading.value = false;
            const data = response.data.dataCurp;
            form.name = data.nombres.toUpperCase() + ' ' + data.apellidoPaterno.toUpperCase() + ' ' + data.apellidoMaterno.toUpperCase()
        }).catch(function (error) {
            if (error.response) {
                if (error.response.status == 500) {
                    Swal.fire({
                        title: "CURP Incorrecta!",
                        text: "La CURP ingresada no es valida, intente nuevamente",
                        icon: "info",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok!",
                    });
                }
            }
            form.reset('name')
            isLoading.value = false
        })
};

</script>

<template>
    <div class="vl-parent">
        <loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true" />
    </div>
    <div class="md:w-1/2 mb-5">
        <label class="font-bold">CURP:</label>
        <div class="md:flex md:space-x-1 mb-1 mt-2">
            <div class="md:w-full max-lg:mb-5">
                <FormControl placeholder="Ingresa CURP" v-model="form.curp" maxlength="18" />
            </div>
            <div class="max-lg:mb-5 my-auto">
                <BaseButton class="w-full" label="Buscar CURP" color="info" :icon="mdiMagnify" @click="getCurp()" />
            </div>
        </div>
        <JetInputError class="mb-5" :message="form.errors.curp" />
    </div>
    <div class="md:flex md:space-x-4 mb-5">
        <div class="md:w-1/2 max-lg:mb-5">
            <FormField label="Nombre del usuario:" :required="true" :error="form.errors.name">
                <FormControl v-model="form.name" placeholder="Nombre del usuario" />
            </FormField>
        </div>
        <div class="md:w-1/2">
            <FormField label="Correo Electrónico:" :required="true" :error="form.errors.email">
                <FormControl v-model="form.email" type="email" placeholder="Correo Electrónico" />
            </FormField>
        </div>
    </div>
    <FormField :label="canEdit ? 'Nueva contraseña:' : 'Contraseña:'" :required="true" :error="form.errors.password">
        <FormControl v-model="form.password" placeholder="Contraseña" type="password" />
    </FormField>
    <FormField label="Selecciona un rol:" :required="true" help="Puedes asignarle uno o más roles al usuario">
        <table class="mb-5">
            <thead>
                <tr>
                    <th />
                    <th>Nombre de Rol</th>
                    <th>Descripción</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in propsData.roles" :key="item.id">
                    <td class="align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-book-half" viewBox="0 0 16 16">
                            <path
                                d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                        </svg>
                    </td>
                    <td data-label="Nombre">
                        {{ item.name }}
                    </td>
                    <td data-label="Descripción">
                        {{ item.description }}
                    </td>
                    <td data-label="Estatus">
                        <label class="p-2 inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" :value="{ id: item.id }" :id="'role_' + item.id"
                                :checked="checkedRole(item)" @change="toggleRole(item)">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>

                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
    </FormField>
</template>
