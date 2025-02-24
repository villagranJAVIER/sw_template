<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import BaseButton from '@/Components/BaseButton.vue';
import { mdiEmailArrowRight } from '@mdi/js';
import HeadLogo from '@/Components/HeadLogo.vue';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <HeadLogo title="Verificar correo" />
    <LayoutWelcome>
        <section class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="max-w-lg w-full">
                <div class="flex justify-center mb-4">
                    <img src="/img/logo.png" alt="User" width="100">
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="mb-4 text-base text-gray-600">
                        ¡Gracias por registrarte! Antes de comenzar, ¿podría verificar su dirección de correo
                        electrónico
                        haciendo clic en el enlace que le acabamos de enviar por correo electrónico? Si no recibió el
                        correo
                        electrónico, con gusto le enviaremos otro.
                    </div>

                    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
                        Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que
                        proporcionó
                        durante el registro.
                    </div>

                    <form @submit.prevent="submit">
                        <div class="mt-4 flex items-center justify-between gap-4">
                            <BaseButton :class="{ 'opacity-45': form.processing }" color="info"
                                :icon="mdiEmailArrowRight" label="Enviar email" type="submit" @click="submit" />

                            <Link :href="route('logout')" method="post" as="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cerrar sesión
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </LayoutWelcome>
</template>
