<script setup>
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { mdiArrowRight  } from '@mdi/js';

</script>

<template>
    <section class="py-20 bg-white dark:bg-blue-950">
        <div
            class="max-w-screen-xl mx-auto text-gray-600 gap-x-12 items-center justify-between overflow-hidden md:flex md:px-8">
            <div class="flex-none space-y-5 px-4 sm:max-w-lg md:px-0 lg:max-w-xl">
                <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                    Over 200 successful deals
                </p>
                <h1 class="text-4xl text-gray-800 dark:text-blue-400 font-extrabold md:text-5xl">
                    <slot name="title">
                    </slot>
                </h1>
                <p class="dark:text-gray-400">
                    <slot name="description">
                    </slot>
                </p>

                <BaseButtons>
                    <BaseButton label="Descubrir" color="info"/>
                    <BaseButton label="Empieza ahora" color="white" :icon="mdiArrowRight"/>
                </BaseButtons>
                
            </div>
            <div class="flex-none mt-14 md:mt-0 md:max-w-xl">
                <img src="https://images.unsplash.com/photo-1573164713619-24c711fe7878?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1738&q=80"
                    class=" md:rounded-tl-[108px]" alt="" />
            </div>
        </div>
    </section>
</template>