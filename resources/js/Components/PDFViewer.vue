<script setup>
import CardBox from "@/Components/CardBox.vue";
import { ref, watch, watchEffect, inject } from "vue";
import axios from "axios";
import BaseButton from "@/Components/BaseButton.vue";
import Swal from "sweetalert2";
import { mdiClose } from "@mdi/js";

const props = defineProps({
    routeName: {
        type: String,
        required: true,
    },
});

const showPDF = ref(false);
const filePath = ref("");
const fileName = ref("");
const { fileId, setFile } = inject("fileId");

const getPDF = () => {
    if (fileId.value != 0) {
        axios
            .get(route(props.routeName, { id: fileId.value }))
            .then((response) => {
                if (response.status === 200) {
                    const data = response.data;
                    filePath.value = data[1];
                    fileName.value = data[0];
                    showPDF.value = true;
                    // fileId.value = 0;
                    setFile(0);
                    window.open(filePath.value, fileName.value);
                }
            })
            .catch(function (error) {
                if (error.response) {
                    if (error.response.status == 500) {
                        Swal.fire({
                            title: "Error",
                            text: "Se produjo un error al consultar el archivo!",
                            icon: "error",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok",
                        });
                    }
                }
            });
    }
};

watchEffect(getPDF);
</script>
