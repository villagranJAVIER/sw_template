<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import FormField from '@/Components/FormField.vue';
import FormControl from '@/Components/FormControl.vue';
import { mdiAccount, mdiAsterisk, mdiLogin, mdiEmail } from '@mdi/js'
import BaseButton from '@/Components/BaseButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue';
import HeadLogo from '@/Components/HeadLogo.vue';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <LayoutGuest>

        <HeadLogo title="Recuperar contraseña" />
        <SectionFullScreen bg="white">
            <div class="max-w-xl">
                <CardBox rounded="rounded-lg" padding="p-6" is-form @submit.prevent="submit">
                    <h1 class="my-4 text-center text-2xl lg:text-3xl font-bold dark:text-white">
                        Recuperar contraseña
                    </h1>
                    <div class="mb-4 text-sm text-justify dark:text-white">
                        Introduce tu correo electrónico registrado para recibir un enlace que te permitirá restablecer
                        tu contraseña.
                    </div>

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                    </div>

                    <FormField required label="Correo electrónico" label-for="Correo electrónico"
                        class="dark:text-white" help="Por favor, introduce tu email" :error="form.errors.email">
                        <FormControl v-model="form.email" :icon="mdiEmail" placeholder="ejemplo@correo.com" id="Correo electrónico"
                            autocomplete="email" type="email" required />
                    </FormField>

                    <BaseButtons>
                        <BaseButton class="w-full" color="info" label="Enviar correo"
                            @click="submit" />
                    </BaseButtons>
                </CardBox>
            </div>
        </SectionFullScreen>
    </LayoutGuest>
</template>
