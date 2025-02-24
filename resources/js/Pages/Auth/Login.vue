<script setup>
/* import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'; */
import { useForm, Head, Link } from '@inertiajs/vue3'
import { mdiAccount, mdiAsterisk, mdiLogin } from '@mdi/js'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import FormValidationErrors from '@/Components/FormValidationErrors.vue'
import NotificationBarInCard from '@/Components/NotificationBarInCard.vue'
import BaseLevel from '@/Components/BaseLevel.vue'
import HeadLogo from '@/Components/HeadLogo.vue'

const props = defineProps({
    canResetPassword: Boolean,
    status: {
        type: String,
        default: null
    }
})

const form = useForm({
    email: '',
    password: '',
    remember: []
})

const submit = () => {
    form
        .transform(data => ({
            ...data,
            remember: form.remember && form.remember.length ? 'on' : ''
        }))
        .post(route('login.store'), {
            onFinish: () => form.reset('password'),
        })
}
</script>

<template>
    <HeadLogo title="Iniciar sesión" />
    <LayoutGuest>
        <SectionFullScreen bg="white" v-slot="{ cardClass }">
            <div class="lg:max-w-4xl lg:grid lg:grid-cols-3">
                <CardBox rounded="rounded-t-lg lg:rounded-l-lg" padding="p-6" is-form @submit.prevent="submit"
                    class="w-full col-span-2">
                    <h1 class="my-4 text-center text-2xl lg:text-3xl font-bold dark:text-white">Bienvenido</h1>

                    <FormValidationErrors />

                    <NotificationBarInCard v-if="status" color="info">
                        {{ status }}
                    </NotificationBarInCard>

                    <FormField label="Correo electrónico:" required help="Por favor, introduce tu email"
                        class="dark:text-white">
                        <FormControl v-model="form.email" :icon="mdiAccount" type="email"
                            placeholder="Correo electrónico" required />
                    </FormField>

                    <FormField label="Contraseña:" required help="Por favor, introduce tu contraseña"
                        class="dark:text-white">
                        <FormControl v-model="form.password" :icon="mdiAsterisk" type="password"
                            placeholder="Contraseña" required />
                    </FormField>

                    <div class="flex justify-between md:mb-5">
                        <FormCheckRadioGroup class="md:w-1/2 max-lg:mb-5 dark:text-white" v-model="form.remember"
                            name="remember" :options="{ remember: 'Recordar' }" />
                        <Link href="forgot-password"
                            class="text-blue-500 underline-offset-4 hover:underline hover:text-blue-700 hover:dark:text-blue-400">
                        Olvidaste tu
                        contraseña? </Link>
                    </div>

                    <BaseButtons>
                        <BaseButton class="w-full" type="submit" color="info" label="Iniciar sesion"
                            :class="{ 'opacity-25': form.processing }" :processing="form.processing" />
                    </BaseButtons>
                </CardBox>

                <div
                    class="lg:rounded-r-lg lg:bg-[url('/img/login-image.jpg')] lg:relative lg:h-full lg:overflow-hidden lg:bg-cover lg:bg-center">
                    <div
                        class="p-4 text-center flex items-center justify-center h-full text-white lg:bg-black/75">
                        <div class="block px-2">
                            <h2 class="font-bold text-xl lg:text-3xl mb-4 text-black lg:text-white dark:text-white">Sistema con reestricción de acceso</h2>
                            <p class="text-xs text-gray-600 lg:text-white dark:text-white">Regresar al inicio</p>
                            <Link href="/" class="lg:hidden text-xs text-blue-500 underline-offset-4 hover:underline hover:text-blue-700 hover:dark:text-blue-400">Da clic Aquí</Link>
                                
                            <BaseButton class="w-auto mt-6 hidden lg:flex" type="submit" color="info" label="Inicio"
                                routeName="welcome" />
                        </div>
                    </div>
                </div>

            </div>
        </SectionFullScreen>
    </LayoutGuest>
</template>
