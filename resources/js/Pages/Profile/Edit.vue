<script setup>
import { provide, reactive } from "vue";
import { useMainStore } from "@/stores/main";
import {
    mdiAccount,
    mdiMail,
    mdiAsterisk,
    mdiFormTextboxPassword,
    mdiGithub,
} from "@mdi/js";
import SectionMain from "@/Components/SectionMain.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import FormFilePicker from "@/Components/FormFilePicker.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import UserCard from "@/Components/UserCard.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";

import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
    name: 'Edit',    
    user: { type: Object, default: {}, required: true }
});

provide('user', props.user)

</script>

<template>
    <LayoutMain>
        <HeadLogo title="Perfil" />
        <SectionTitleLineWithButton :icon="mdiAccount" title="Perfil" main>
            <a :href="route('dashboard')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </a>
        </SectionTitleLineWithButton>
        <CardBox class="mb-10">
            <UpdateProfileInformationForm class="w-full" />
        </CardBox>

        <CardBox class="mb-10">
            <UpdatePasswordForm class="w-full" />
        </CardBox>

        <CardBox class="mb-10">
            <DeleteUserForm class="w-full" />
        </CardBox>
    </LayoutMain>
</template>
