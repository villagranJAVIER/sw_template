<script setup>
import { computed, ref, watch, onMounted} from "vue";
import debounce from "lodash/debounce";
import { mdiClose } from "@mdi/js";
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
    margin: {
        type: String,
        default: ''
    },
    textClass: {
        type: String,
        default: "text-base",
    },
    options: {
        type: Object,
        default: {}
    },
    placeholder: {
        type: String,
        default: 'Empieza a escribir',
    },
    dropdownClass: {
        type: String,
        required: false,
        default:
            "p-2 absolute w-full z-50 bg-white dark:bg-gray-800 dark:text-white border border-gray-300 mt-1 max-h-32 overflow-hidden overflow-y-scroll rounded-md shadow-md",
    },
    itemSelected: {
        required: false
    },
    borderless: Boolean,
    required: Boolean,
    disabled: Boolean,
});

const model = defineModel();
const search = ref('');
const showOptions = ref(false);
const emit = defineEmits(['search']);

const inputElClass = computed(() => {
    const base = [
        "w-full pr-8 max-w-full focus:outline-none border-gray-400 dark:border-gray-600 rounded",
        "dark:placeholder-gray-400 dark:text-white bg-white dark:bg-slate-800",
        "dark:text-gray-400",
        props.height,
        props.textClass,
        props.borderless ? "border-0" : "border",
    ];

    if(props.margin){
        base.push(props.margin);
    }
    if (props.icon) {
        base.push("pl-10");
    }

    return base;
});

const placeholderInput = ref(props.placeholder);
const previousSelected = ref('');

const handleClick = (item) => {
    showOptions.value = false;
    search.value = item.name;
    previousSelected.value = item.name;
    placeholderInput.value = item.name;
    model.value = item.id;
};

const handleSearch = () => {
    showOptions.value = true;
    search.value = '';   
};

const handleBlur = () => {
    setTimeout(() => {
        showOptions.value = false;
        if(!previousSelected.value){
            placeholderInput.value = props.placeholder;
            search.value = '';
        }else{
            search.value = previousSelected.value;
        }
    }, 200);
};

const reset = () => {
    previousSelected.value = '';
    placeholderInput.value = props.placeholder
    search.value = '';
    model.value = null;
};

watch(
    search,
    debounce(() => {
        if (search.value !== '' && search.value !== previousSelected.value) {
            emit('search', search.value);
        }
    }, 500)
);

onMounted(() => {
    if(props.itemSelected){
        model.value = props.itemSelected.id;
        previousSelected.value = props.itemSelected.name;
        placeholderInput.value = props.itemSelected.name;
        search.value = props.itemSelected.name;
    }
});

</script>

<template>
    <div class="relative">
        <input :disabled="disabled" :required="required" v-model="search" @focus="handleSearch" @blur="handleBlur"
            :placeholder="placeholderInput" :class="inputElClass" />

        <div v-if="model && !disabled" :class="margin" class="text-gray-800 dark:text-white absolute inset-y-0 right-0 px-3 flex items-center">
            <BaseIcon @click.prevent="reset" :path="mdiClose" class="cursor-pointer" />
        </div>

        <div v-show="search && showOptions" :class="dropdownClass">
            <ul>
                <li v-if="options?.length" @click="handleClick(item)" v-for="(item, index) in options"
                    :key="index" class="px-3 py-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700">
                    {{ item.name }}
                </li>
                <li v-else class="px-3 py-2 text-center">
                    No se encontraron resultados
                </li>
            </ul>
        </div>
    </div>
</template>
