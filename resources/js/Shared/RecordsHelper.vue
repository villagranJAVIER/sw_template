<template>
    <div class="row d-flex flex-row justify-content-center" v-if="!thereAreResults || loadingResults">
        <div class="col-12" :class="{ 'card card-light card-body': cardStyle }">
            <div v-if="loadingResults" class="text-center">
                <div class="spinner-border text-info" role="status">
                    <span class="sr-only"></span>
                </div>
                <h3 class="text-center">
                    Cargando resultados.<br>
                    <span class="text-sm">
                        <i class="bi bi-info-circle"></i>
                        Por favor espere
                    </span>
                </h3>
            </div>
            <div v-if="!loadingResults && !thereAreResults" class="flex flex-col items-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-braces" width="44"
                        height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 4a2 2 0 0 0 -2 2v3a2 3 0 0 1 -2 3a2 3 0 0 1 2 3v3a2 2 0 0 0 2 2" />
                        <path d="M17 4a2 2 0 0 1 2 2v3a2 3 0 0 0 2 3a2 3 0 0 0 -2 3v3a2 2 0 0 1 -2 2" />
                    </svg>
                </div>
                <div class="mt-2 text-xl flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="32"
                        height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M12 9h.01" />
                        <path d="M11 12h1v4h1" />
                    </svg>
                    <span class="ml-2">Sin resultados encontrados.</span>
                </div>
                <div class="mt-2 text-xl">Si cree que es un problema, consulte al administrador del sistema.</div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        cardStyle: {
            type: Boolean,
            default: true,
            required: false
        },
        thereAreResults: {
            type: Boolean,
            default: false,
            required: true
        },
        loadingResults: {
            type: Boolean,
            default: false,
            required: true
        }
    }
}
</script>
<style scoped></style>
