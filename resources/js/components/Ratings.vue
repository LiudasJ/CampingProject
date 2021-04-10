<template>
    <div class="ratings-controller p-20">
        <div class="ratings-heading">
            <h2 class="heading-color">Leave a Review for this camping!</h2>
        </div>
        <div class="ratings-scale-container mb-20">
            <i class="far fa-star ps-10 pointer" 
                v-for='star in 10' 
                :key='star' 
                @click="rate(star)"
                :class="{ 'fas': star <= score }">
            </i>
        </div>
        <div class="mb-20">
            <span>Score: {{score}} / 10</span>
        </div>
        <div>
            <input @click="publish" type="submit" class="btn" value="Submit">
        </div>
        <div class="mt-10">
            <span v-if="result">{{result}}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['camp'],
    data: function() {
        return {
            score: '',
            id: this.camp,
            result: ''
        }
    },
    methods: {
        rate(star) {
            this.score = star
        },
        publish() {
            axios.post('/campings/' + this.id + '/rate', {
                rating: this.score
            })
            .then(response => {
                if (response.status === 200) {
                    this.score = 0;
                    this.result = response.data.result;
                }
            })
            .catch(e => {
                if (e.response.status === 422) {
                    this.result = e.response.data.errors.rating[0]  
                }
            })
        }
    },
    created() {
    }
}
</script>