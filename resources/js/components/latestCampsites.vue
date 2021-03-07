<template>
    <div class="latest-campings-container">
        <p class="main-text-color font-bold font-lg">Recently published campings</p>
        <div class="campsite-card-container flex wrap">
            <campsite 
                v-for="camping in campings" :key="camping.id"
                v-on:campingsChanged="$emit('reloadCampings')" 
                :camping="camping"
                :auth="auth">
            </campsite>
        </div>
    </div>
</template>
<script>

import campsite from "./campsite"

export default {
    props: ['campings', 'auth'],
    components: {campsite}
}
</script>
