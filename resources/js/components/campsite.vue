<template>
    <div class="camping-card flex centering flex-col space-around relative shadow">
        <h2 class="text-center"> 
            <span class="font-bold font-lg main-text-color">{{camping.name}}</span>
        </h2>
        <div class="camp-image relative" :style="[camping.img_path ? {'background-image': 'url(../storage/' + camping.img_path + ')'} : {'background': '#FFF'}]">
            <!-- <div class="absolute upload-container">
                <upload-container v-on:imageChanged="$emit('campingsChanged')" :camping="camping"></upload-container>
            </div> -->
        </div>
        <div class="camping-card-heading">
            <div class="location-tags-container flex">
                <div class="location-container">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="font-bold font-sm main-text-color">{{camping.country}},</span> 
                    <span class="font-bold font-sm main-text-color">{{camping.city}}</span>
                    <div class="rating-container mt-10 flex">
                        <i v-for='index in rating' :key='index' class="fas fa-star"></i>
                    </div>
                </div>
                <div class="tags-container">
                    <div v-for="tag in camping.tags" :key="tag.id">
                        <i v-if="tag.name === 'Pool'" class="fas fa-swimmer"></i>
                        <i v-if="tag.name === 'Wifi'" class="fas fa-wifi"></i>
                        <i v-if="tag.name === 'Parking'" class="fas fa-parking"></i>
                        <span class="tag-name">{{tag.name}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="reviews > 0" class="font-sm"> Review: {{reviews}} / 10 </div>
        <div v-if="reviews == 0" class="font-sm"> No reviews yet </div>
        <div class="more-container main-bg-color flex centering">
            <a v-bind:href="'/campings/' + camping.id">More Here</a>
        </div>
        <div>
            <a v-bind:href="'http://' + camping.website"> <span class="font-bold color-black font-sm">Visit us</span></a> 
        </div>
    </div>
</template>
<script>

export default {
    data: function () {
        return {
            id: this.camping.id,
            reviews: this.review,
            campingData: '',
            tags: '',
            rating: this.camping.rating
        }
    },
    props: ['camping', 'review']
}
</script>

