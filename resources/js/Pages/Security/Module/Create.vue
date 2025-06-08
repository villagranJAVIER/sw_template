<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPlus, mdiPencil, mdiContentSave, mdiClose } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: 'Create',
    title: {
        type: String,
        required: true
    },
    routeName: {
        type: String,
        required: true
    },
});
const form = useForm({ name: null, description: null, key: null, });
const saveForm = () => {
    form.post(route(`${props.routeName}store`));
};


</script>

<template>
    <HeadLogo :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPlus" :title="title" main :route-back="`${routeName}index`" />

        <CardBox isForm @submit.prevent="saveForm">
            <FormField label="Nombre del módulo:" :required="true" help="Nombre del módulo" :error="form.errors.name">
                <FormControl v-model="form.name" placeholder="Nombre del módulo" />
            </FormField>

            <FormField label="Descripción:" :required="true" help="" :error="form.errors.description">
                <FormControl v-model="form.description" placeholder="Descripción" />
            </FormField>

            <FormField label="Clave del Módulo:" :required="true" :error="form.errors.key">
                <FormControl v-model="form.key" placeholder="Clave del Módulo" />
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
