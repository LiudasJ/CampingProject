<template>
    <div class="camping-card flex centering flex-col space-around relative shadow">
        <h2 class="text-center"> 
            <span class="font-bold font-lg main-text-color">{{camping.name}}</span>
        </h2>
        <div v-if="camping.images.length == 0" class="camp-image relative" :style="{'background': 'url(https://lh3.googleusercontent.com/proxy/ZeUSGUbuVCw1pHUkHz0ietJ8qYbyKJlIe5lNdoRVLzO_hhXih3AagJBKAfxuuXKcKlwuPWgpWgtjxh008EdTNmk3H546_HV7OFpP0P1_6JOS4F07ThZutit0byXhl5ivl1nHrxIxdenMGWSQgAtzTu7d8PBdBj7B6oSwqIfSe_x-M1r0bij5DI5nwnmyJEk7VthiXg)'}"></div>
        <div v-if="camping.images.length > 0" class="camp-image relative" :style="{'background-image': 'url(../storage/' + camping.images[0].img_path + ')'}"></div>
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

