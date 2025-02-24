<script setup>
import { computed, ref, onMounted, onBeforeUnmount } from "vue";
import { useMainStore } from "@/stores/main";
import FormControlIcon from "@/Components/FormControlIcon.vue";
import { mdiEye, mdiEyeOff } from "@mdi/js";
import BaseButton from "@/Components/BaseButton.vue";
import BaseIcon from "./BaseIcon.vue";

const props = defineProps({
  name: {
    type: String,
    default: null,
  },
  height: {
    type: String,
    default: "h-12",
  },
  textClass: {
    type: String,
    default: "text-base",
  },
  id: {
    type: String,
    default: null,
  },
  autocomplete: {
    type: String,
    default: null,
  },
  maxlength: {
    type: String,
    default: null,
  },
  placeholder: {
    type: String,
    default: null,
  },
  inputmode: {
    type: String,
    default: null,
  },
  disabled: {
    type: Boolean,
    default: null,
  },
  icon: {
    type: String,
    default: null,
  },
  options: {
    type: Array,
    default: null,
  },
  type: {
    type: String,
    default: "text",
  },
  modelValue: {
    type: [String, Number, Boolean, Array, Object],
    default: "",
  },
  valueSelect: {
    type: String,
    default: "id",
  },
  optionNames: {
    type: Object,
    default: null,
  },
  separator: {
    type: String,
    default: " - ",
  },
  selectIsDisabled: {
    type: Boolean,
    default: true,
  },
  min: {
    type: [String, Object],
    default: null,
  },
  max: {
    type: [String, Object],
    default: null,
  },
  required: Boolean,
  borderless: Boolean,
  transparent: Boolean,
  ctrlKFocus: Boolean,
  disabled: Boolean,
});

const emit = defineEmits(["update:modelValue", "setRef"]);

const computedValue = computed({
  get: () => props.modelValue,
  set: (value) => {
    emit("update:modelValue", value);
  },
});

const inputElClass = computed(() => {
  const base = [
    "w-full max-w-full focus:outline-none border-gray-400 dark:border-gray-600 rounded",
    "dark:placeholder-gray-400",
    props.height,
    props.textClass,
    props.type === 'file' ? 'px-auto py-auto' : 'px-2 py-1',
    props.borderless ? "border-0" : "border",
    props.disabled
      ? "bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-200 border-slate-200 shadow-none cursor-not-allowed"
      : "bg-white dark:text-white dark:bg-slate-800",
    props.transparent === "bg-transparent",
  ];

  if (props.icon) {
    base.push("pl-10");
  }

  if (props.type === 'password') {
    base.push("pr-10");
  }

  return base;
});

const computedType = computed(() => (props.options ? "select" : props.type));

const controlIconH = computed(() =>
  props.type === "textarea" ? "h-full" : "h-12"
);

const mainStore = useMainStore();

const selectEl = ref(null);

const textareaEl = ref(null);

const inputEl = ref(null);

const showPassword = ref([]);

onMounted(() => {
  if (selectEl.value) {
    emit("setRef", selectEl.value);
  } else if (textareaEl.value) {
    emit("setRef", textareaEl.value);
  } else {
    emit("setRef", inputEl.value);
  }
});

if (props.ctrlKFocus) {
  const fieldFocusHook = (e) => {
    if (e.ctrlKey && e.key === "k") {
      e.preventDefault();
      inputEl.value.focus();
    } else if (e.key === "Escape") {
      inputEl.value.blur();
    }
  };

  onMounted(() => {
    if (!mainStore.isFieldFocusRegistered) {
      window.addEventListener("keydown", fieldFocusHook);
      mainStore.isFieldFocusRegistered = true;
    } else {
      // console.error('Duplicate field focus event')
    }
  });

  onBeforeUnmount(() => {
    window.removeEventListener("keydown", fieldFocusHook);
    mainStore.isFieldFocusRegistered = false;
  });
}
</script>

<template>
  <div class="relative">
    <select
      v-if="computedType === 'select'"
      :id="id"
      v-model="computedValue"
      :name="name"
      :class="inputElClass"
      :disabled="disabled"
    >
      <option :value="null" selected :disabled="selectIsDisabled">
        {{ placeholder ? placeholder : "Seleccione una opción" }}
      </option>
      <option
        v-for="option in options"
        :key="option?.id ?? option"
        :value="option?.[valueSelect] ?? option"
      >
        <span v-if="optionNames != null">
          <span v-for="(o, index) in optionNames" :key="index">
            {{ option[o] }}{{ index !== optionNames.length - 1 ? props.separator : "" }}
          </span>
        </span>
        <span v-else>
          {{ option?.name ?? option }}
        </span>
      </option>
    </select>
    <textarea
      v-else-if="computedType === 'textarea'"
      :id="id"
      v-model="computedValue"
      :class="inputElClass"
      :name="name"
      :maxlength="maxlength"
      :placeholder="placeholder"
      :required="required"
      :disabled="disabled"
    />
    <!-- <input
      v-else
      :id="id"
      ref="inputEl"
      v-model="computedValue"
      :name="name"
      :disabled="disabled"
      :maxlength="maxlength"
      :inputmode="inputmode"
      :autocomplete="autocomplete"
      :required="required"
      :placeholder="placeholder"
      :min="min"
      :max="max"
      :type="showPassword[id] ? 'text' : computedType"
      :class="inputElClass"
      class="invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500"
    /> -->
    <input
      v-else
      :id="id"
      ref="inputEl"
      v-model="computedValue"
      :name="name"
      :disabled="disabled"
      :maxlength="maxlength"
      :inputmode="inputmode"
      :autocomplete="autocomplete"
      :required="required"
      :placeholder="placeholder"
      :min="min"
      :max="max"
      :type="showPassword[id] ? 'text' : computedType"
      :class="inputElClass"
    />
    <FormControlIcon v-if="icon" :icon="icon" :h="controlIconH" />
    <BaseIcon
      @click="showPassword[id] = !showPassword[id]"
      class="cursor-pointer absolute top-0 right-0 z-10 mr-4 text-gray-500"
      v-if="type == 'password'"
      :path="showPassword[id] ? mdiEyeOff : mdiEye"
      w="10"
      :h="controlIconH"
    />
  </div>
</template>
