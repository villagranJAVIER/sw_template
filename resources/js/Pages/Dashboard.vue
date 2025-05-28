<script setup>
import { Head } from "@inertiajs/vue3";
import { computed, ref, onMounted } from "vue";
import { useMainStore } from "@/stores/main";
import {
  mdiAccountMultiple,
  mdiBookEducation,
  mdiChartTimelineVariant,
  mdiMonitorCellphone,
  mdiReload,
  mdiGithub,
  mdiChartPie,
  mdiViewModule,
  mdiBullhorn,
} from "@mdi/js";
import SectionMain from "@/Components/SectionMain.vue";
import CardBoxWidget from "@/Components/CardBoxWidget.vue";
import CardBox from "@/Components/CardBox.vue";
import TableSampleClients from "@/Components/TableSampleClients.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBoxTransaction from "@/Components/CardBoxTransaction.vue";
import CardBoxClient from "@/Components/CardBoxClient.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import SectionBannerStarOnGitHub from "@/Components/SectionBannerStarOnGitHub.vue";
import HeadLogo from "@/Components/HeadLogo.vue";

const props = defineProps({
  data: {
    type: Object,
    default: {},
  },
});
</script>

<template>
  <HeadLogo title="Inicio" />
  <LayoutAuthenticated>
    <SectionMain>
      Dashboard
      <h1 class="text-black font-[1]">holaaaaaaaaaaa</h1>
    </SectionMain>
  </LayoutAuthenticated>
</template>
