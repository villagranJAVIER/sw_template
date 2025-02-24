<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import HeadLogo from '@/Components/HeadLogo.vue';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import { Head, Link } from '@inertiajs/vue3';
import { mdiFacebook, mdiGithub, mdiTwitter, mdiLinkedin } from '@mdi/js';

const props = defineProps({
    title: {
        type: String,
        required: true
    }
});

const team = [
    {
        avatar: "https://images.unsplash.com/photo-1511485977113-f34c92461ad9?ixlib=rb-1.2.1&q=80&fm=jpg&crop=faces&fit=crop&h=200&w=200&ixid=eyJhcHBfaWQiOjE3Nzg0fQ",
        name: "Martiana dialan",
        title: "Product designer",
        desc: "Lorem Ipsum is simply dummy text of the printing and typesettin industry.",
        linkedin: "javascript:void(0)",
        twitter: "javascript:void(0)",
    },
    {
        avatar: "https://api.uifaces.co/our-content/donated/xZ4wg2Xj.jpg",
        name: "Micheal colorand",
        title: "Software engineer",
        desc: "Lorem Ipsum is simply dummy text of the printing and typesettin industry.",
        linkedin: "javascript:void(0)",
        twitter: "javascript:void(0)",
    },
    {
        avatar: "https://randomuser.me/api/portraits/women/79.jpg",
        name: "Brown Luis",
        title: "Full stack engineer",
        desc: "Lorem Ipsum is simply dummy text of the printing and typesettin industry.",
        linkedin: "javascript:void(0)",
        twitter: "javascript:void(0)",
    },
    {
        avatar: "https://randomuser.me/api/portraits/women/63.jpg",
        name: "Lysa sandiago",
        title: "Head of designers",
        desc: "Lorem Ipsum is simply dummy text of the printing and typesettin industry.",
        linkedin: "javascript:void(0)",
        twitter: "javascript:void(0)",
    },
    {
        avatar: "https://randomuser.me/api/portraits/men/86.jpg",
        name: "Daniel martin",
        title: "Product designer",
        desc: "Lorem Ipsum is simply dummy text of the printing and typesettin industry.",
        linkedin: "javascript:void(0)",
        twitter: "javascript:void(0)",
    },
    {
        avatar: "https://randomuser.me/api/portraits/men/46.jpg",
        name: "Vicky tanson",
        title: "Product manager",
        desc: "Lorem Ipsum is simply dummy text of the printing and typesettin industry.",
        linkedin: "javascript:void(0)",
        twitter: "javascript:void(0)",
    },
];

</script>

<template>
    <HeadLogo :title="title" />
    <LayoutWelcome>
        <section class="py-14">
            <div class="max-w-screen-xl mx-auto px-4 text-center md:px-8">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-gray-800 dark:text-blue-200 text-3xl font-semibold sm:text-4xl">
                        Cómite Organizador
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy.
                    </p>
                </div>
                <div class="mt-12">
                    <ul class="grid gap-8 sm:grid-cols-2 md:grid-cols-3">
                        <li v-for="(item, idx) in team" :key="idx">
                            <div class="w-24 h-24 mx-auto">
                                <img :src="item.avatar" class="w-full h-full rounded-full" alt="" />
                            </div>
                            <div class="mt-2">
                                <h4 class="text-gray-700 dark:text-gray-300 font-semibold sm:text-lg">{{ item.name }}
                                </h4>
                                <p class="text-blue-600 dark:text-emerald-500">{{ item.title }}</p>
                                <p class="text-gray-500 mt-2 mb-2">{{ item.desc }}</p>

                                <BaseButtons class=" flex justify-center items-center">
                                    <BaseButton :icon="mdiFacebook" target="_blank" href="https://www.facebook.com/"
                                        color="contrast" roundedFull />
                                    <BaseButton :icon="mdiGithub" target="_blank" href="https://github.com/"
                                        color="contrast" roundedFull />
                                    <BaseButton :icon="mdiTwitter" target="_blank" href="https://twitter.com/?lang=es"
                                        color="contrast" roundedFull />
                                    <BaseButton :icon="mdiLinkedin" target="_blank" href="https://mx.linkedin.com/"
                                        color="contrast" roundedFull />
                                </BaseButtons>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </LayoutWelcome>
</template>