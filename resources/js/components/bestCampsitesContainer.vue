<template>
    <div class="best-campings-container flex flex-col centering flex-start">
        <i class="fas fa-star"></i>
        <p class="main-text-color font-bold font-lg">Top rated campings</p>
        <best-campsites v-for="camping in bestCampings" :key="camping.id" :bestCamping ="camping"></best-campsites>
    </div>
</template>

<script>
    import bestCampsites from "./bestCampsites"

    export default {
        props: ['bestCampings'],
        components: {bestCampsites},
        mounted() {
        }
    }
</script>
