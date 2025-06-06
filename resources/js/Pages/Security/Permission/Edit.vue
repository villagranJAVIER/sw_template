<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPencil, mdiTrashCan, mdiContentSave, mdiClose } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: 'Edit',
    title: {
        type: String,
        required: true
    },
    modules: { type: Object, required: true },
    record: { type: Object, required: true },
    routeName: {
        type: String,
        required: true
    },
});

const form = useForm({ ...props.record });
const saveForm = () => {
    form.put(route(`${props.routeName}update`, props.record.id));
};
const deleteForm = () => {
    Swal.fire({
        title: "¿Esta seguro?",
        text: "Esta acción no se puede revertir",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#1C64F2",
        confirmButtonColor: "#E02424",
        confirmButtonText: "Si!, eliminar registro!",
    }).then((res) => {
        if (res.isConfirmed) {
            form.delete(route(`${props.routeName}destroy`, props.record.id));
        }
    });
};


</script>

<template>
    <HeadLogo :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPencil" :title="title" main>
            <Link :href="route(`${routeName}index`)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </Link>
        </SectionTitleLineWithButton>
        <CardBox isForm @submit.prevent="saveForm">
            <FormField label="Nombre del módulo:" :required="true" help="Selecciona un módulo disponible"
                :error="form.errors.module_key">
                <FormControl v-model="form.module_key" :options="modules" valueSelect="key" />
            </FormField>
            <FormField label="Nombre del permiso:" help="Ejemplos: nombre_modulo.index, nombre_modulo.store,
                    nombre_modulo.update, nombre_modulo.delete" :required="true" :error="form.errors.name">
                <FormControl v-model="form.name" placeholder="Nombre del permiso" />
            </FormField>
            <FormField label="Descripción:" help="Ejemplos: index=Leer Registros, store=Crear Registros,
                    update=Actualizar Registros, delete=Eliminar Registros" :required="true"
                :error="form.errors.description">
                <FormControl v-model="form.description" placeholder="Descripción" />
            </FormField>

            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancelar" />
                    <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success" label="Guardar" />
                    <BaseButton color="danger" :icon="mdiTrashCan" @click="deleteForm" label="Eliminar" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
