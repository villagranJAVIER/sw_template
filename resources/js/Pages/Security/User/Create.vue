<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPlus, mdiContentSave, mdiClose } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head, useForm } from "@inertiajs/vue3";
import { provide } from "@vue/runtime-core";
import DataForm from "./DataForm.vue";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: 'Create',
    title: { type: String, required: true },
    routeName: { type: String, required: true },
    roles: { type: Object, required: true },
});

const form = useForm({
    name: null,
    email: null,
    password: null,
    roles: [],
});

const saveForm = () => {
    form.post(route(`${props.routeName}store`));
}

provide('form', form);
provide('propsData', props);

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPlus" :title="title" main :route-back="`${routeName}index`" />
        <CardBox isForm @submit.prevent="saveForm">
            <DataForm />
            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancelar" />
                    <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success"
                        label="Guardar" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
