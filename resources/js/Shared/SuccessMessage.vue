<template>
    <div v-if="hasMessage" class="alert alert-success" role="alert">
        {{ message.success }}
    </div>
</template>

<script>
export default {
    computed : {
        message() {
            return this.$page.props.flash
        },
        hasMessage() {
            return this.message.success;
        },
    }
}
</script>
