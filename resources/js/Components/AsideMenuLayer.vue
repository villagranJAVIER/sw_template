<script setup>
import { mdiLogout, mdiClose } from "@mdi/js";
import { computed } from "vue";
import { useStyleStore } from "@/stores/style.js";
import AsideMenuList from "@/Components/AsideMenuList.vue";
import AsideMenuItem from "@/Components/AsideMenuItem.vue";
import BaseIcon from "@/Components/BaseIcon.vue";

defineProps({
    menu: {
        type: Array,
        required: true,
    },
});

const emit = defineEmits(["menu-click", "aside-lg-close-click"]);

const styleStore = useStyleStore();

const logoutItem = computed(() => ({
    label: "Cerrar Sesión",
    icon: mdiLogout,
    color: "danger",
    isLogout: true,
}));

const menuClick = (event, item) => {
    emit("menu-click", event, item);
};

const asideLgCloseClick = (event) => {
    emit("aside-lg-close-click", event);
};
</script>

<template>
    <aside id="aside" class="lg:py-2 lg:pl-2 w-60 fixed flex z-40 top-0 h-screen transition-position overflow-hidden">
        <div :class="styleStore.asideStyle"
            class="lg:rounded-2xl flex-1 flex flex-col overflow-hidden dark:bg-slate-900">

            <div :class="styleStore.asideBrandStyle"
                class="flex flex-row h-14 items-center justify-between dark:bg-slate-900">
                <div class="justify-center flex w-full p-2">
                    <div>
                        <img class="rounded-xl" src="/img/logo.png" width="35" alt="">
                    </div>
                </div>
                <button class="hidden lg:inline-block xl:hidden p-3" @click.prevent="asideLgCloseClick">
                    <BaseIcon :path="mdiClose" />
                </button>
            </div>

            <div :class="styleStore.darkMode
                ? 'aside-scrollbars-[slate]'
                : styleStore.asideScrollbarsStyle
            " class="flex-1 overflow-y-auto overflow-x-hidden">
                <AsideMenuList :menu="menu" @menu-click="menuClick" />
            </div>

            <ul>
                <AsideMenuItem :item="logoutItem" @menu-click="menuClick" />
            </ul>
        </div>
    </aside>
</template>
