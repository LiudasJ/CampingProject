<template>
    <div class="ratings-controller">
        <div class="ratings-heading">
            <h2>Rate our camping!</h2>
        </div>
        <div class="ratings-scale-container">
            <i v-for='index in 10' :key='index' class="far fa-star"></i>
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