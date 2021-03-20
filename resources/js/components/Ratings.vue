<template>
    <div class="ratings-controller">
        <div class="ratings-heading">
            <h2>Rate our camping!</h2>
        </div>
        <div class="ratings-scale-container">
            <i v-bind="score" v-for='index in 5' :key='index' class="far fa-star"></i>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            score: ''
        }
    }
}
</script>