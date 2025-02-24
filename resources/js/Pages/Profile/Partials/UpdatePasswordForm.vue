<script setup>
import {
    mdiAccount,
    mdiMail,
    mdiAsterisk,
    mdiFormTextboxPassword,
    mdiGithub,
    mdiLock,
    mdiContentSave,
} from "@mdi/js";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, inject, reactive, ref, toRefs } from "vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseButton from "@/Components/BaseButton.vue";

const form = useForm({
    current_password: null,
    password: null,
    password_confirmation: null,
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
            }
            if (form.errors.current_password) {
                form.reset('current_password');
            }
        },
    });
};

const passwordRating = computed(() => {
    const password = String(form.password);
    let rating = 0;
    let barColor = '';
    let barWidth = '';
    if (password.length >= 8) {
        rating += 1;
    }
    const containsUpperCase = /[A-Z]/.test(password);
    const containsLowerCase = /[a-z]/.test(password);
    const containsNumbers = /[0-9]/.test(password);
    const containsSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    if (containsUpperCase) {
        rating += 1;
    }
    if (containsLowerCase) {
        rating += 1;
    }
    if (containsNumbers) {
        rating += 1;
    }
    if (containsSpecialChars) {
        rating += 1;
    }
    if (rating < 3) {
        barColor = 'bg-red-500';
    } else if (rating === 3) {
        barColor = 'bg-yellow-500';
    } else {
        barColor = 'bg-green-500';
    }
    barWidth = `${(rating / 5) * 100}%`;
    return {
        barColor,
        barWidth,
    };
});


</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-slate-100">Actualizar contraseña</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-slate-400">
                Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">

            <FormField label="Contraseña Antigüa:" :error="form.errors.current_password">
                <FormControl v-model="form.current_password" :icon="mdiLock" type="password" required
                    placeholder="Contraseña Antigüa" />
            </FormField>

            <FormField label="Contraseña Nueva:" :error="form.errors.password">
                <FormControl v-model="form.password" :icon="mdiLock" placeholder="Contraseña Nueva" type="password" />
            </FormField>
            <div v-show="form.password != null" class="mb-5">
                <div class="h-2.5 bg-gray-200 w-1/6 rounded-lg mt-1 border border-black">
                    <div :class="passwordRating.barColor" class="h-2 rounded-lg "
                        :style="{ width: passwordRating.barWidth }" />
                </div>
            </div>
            <FormField label="Contraseña Confirmación:" :error="form.errors.password_confirmation">
                <FormControl v-model="form.password_confirmation" :icon="mdiLock" type="password"
                    placeholder="Contraseña Confirmación" required />
            </FormField>

            <div class="flex items-center gap-4">
                <BaseButton title="Guardar" @click="updatePassword" :icon="mdiContentSave" color="success"
                    label="Guardar" />

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Guardado.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
