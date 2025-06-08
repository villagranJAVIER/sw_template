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
import { provide } from "@vue/runtime-core";
import axios from 'axios'
import DataForm from "./DataForm.vue";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: 'Edit',
    title: { type: String, required: true },
    routeName: { type: String, required: true },
    user: { type: Object, default: {}, required: true },
    roles: { type: Object, default: {}, required: true },
});

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: null,
    roles: props.user.roles.map(
        (role) => role.id
    ),
});

const saveForm = () => {
    form.put(route(`${props.routeName}update`, props.user.id));
};

const deleteForm = () => {
    Swal.fire({
        title: '¿Esta seguro?',
        text: 'Esta acción no se puede revertir',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#1C64F2",
        confirmButtonColor: "#E02424",
        confirmButtonText: "Si!, eliminar registro!",
    }).then(res => {
        if (res.isConfirmed) form.delete(route(`${props.routeName}destroy`, props.user.id));
    });
};

provide('form', form);
provide('propsData', props);

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPencil" :title="title" main :route-back="`${routeName}index`" />
        <CardBox isForm @submit.prevent="saveForm">
            <DataForm canEdit />
            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancelar" />
                    <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success"
                        label="Guardar" :processing="form.processing" />
                    <BaseButton color="danger" :icon="mdiTrashCan" @click="deleteForm" label="Eliminar" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
