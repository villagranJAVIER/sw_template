<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPlus, mdiPencil, mdiTrashCan, mdiContentSave, mdiClose } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import { provide, watchEffect } from "@vue/runtime-core";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: 'Create',
    title: {
        type: String,
        required: true
    },
    modules: { type: Object, required: true },

    routeName: {
        type: String,
        required: true
    },
});
const form = useForm({ name: '', guard_name: 'web', description: '', module_key: null });
const saveForm = () => {
    form.post(route(`${props.routeName}store`));
};
watchEffect(() => {
    if (form.module_key) {
        form.name = form.module_key + '.';
    }
});

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPlus" :title="title" main :route-back="`${routeName}index`" />

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
                    update=Actualizar Registros, delete=Eliminar Registros" :required="true" :error="form.errors.description">
                <FormControl v-model="form.description" placeholder="Descripción" />
            </FormField>
            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancelar" />
                    <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success" label="Guardar" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
