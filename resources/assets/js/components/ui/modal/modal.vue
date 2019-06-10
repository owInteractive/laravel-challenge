<template>
    <div v-if="open"
         class="fixed inset-0 z-50 w-full h-screen flex items-center justify-center bg-semi-75">
        <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg p-8 z-1">
            <button
                    aria-label="close"
                    class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
                    @click.prevent="close"
            >
                ×
            </button>

            <slot/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "modal",
        props: {
            open: {
                required: true,
                type: Boolean
            }
        },
        methods: {
            close() {
                this.$emit('close');
            }
        }
    }
</script>

<style scoped>

</style>