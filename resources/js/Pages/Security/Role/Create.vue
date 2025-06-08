<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPlus, mdiContentSave, mdiClose } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { provide } from "@vue/runtime-core";
import DataForm from "./DataForm.vue";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: 'Create',
    title: {
        type: String,
        required: true
    },
    modules: { type: Object, required: true },
    permissions: { type: Object, required: true },

    routeName: {
        type: String,
        required: true
    },
});
const form = useForm({
    name: null,
    description: null,
    guard_name: 'web',
    permissions: []
});
const saveForm = () => {
    form.post(route(`${props.routeName}store`));
}

provide('form', form);
provide('permissions', props.permissions);
provide('modules', props.modules);
provide('disabled', false);

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPlus" :title="title" main :route-back="`${routeName}index`" />
        <DataForm :permissions="permissions" :modules="modules" :form="form" />
        <template #footer>
            <BaseButtons>
                <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancelar" />
                <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success" label="Guardar" />
            </BaseButtons>
        </template>
    </LayoutMain>
</template>
