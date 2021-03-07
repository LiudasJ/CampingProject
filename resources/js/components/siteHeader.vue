<template>
    <div class="header-container flex centering relative">
        <header class="flex flex-col centering">
            <h1 class="text-center main-text-color">Camping Project</h1>
            <p v-if="auth" class="font-bold font-lg text-white header-p">Create, Review, Edit and Delete campings</p>
            <p v-if="!auth" class="font-bold font-lg text-white header-p">Best Campings in Europe!</p>
        </header>
    </div>
</template>

<script>
    export default {
        props: ['auth'],
        data: function() {
            return {
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
