<template>
    <div class="best-camping-card flex centering flex-col relative">
        <div class="camp-image" :style="[bestCamping.img_path ? {'background-image': 'url(../storage/' + bestCamping.img_path + ')'} : {'background': '#FFF'}]"></div>
        <div class="best-camping-right flex-col">
            <p><span class="font-bold">10 Ultimate Things to Do in</span> <span class="font-bold main-text-color">{{bestCamping.name}}</span></p>
            <div>
                <div class="best-campsites-heading flex vertical-align">
                    <span>{{bestCamping.city}}</span>
                    <i class="fas fa-circle font-xs main-text-color"></i>
                    <span>{{bestCamping.country}}</span>
                </div>
                <div class="best-camp-review">Review: {{review.toFixed(0) >  8 ? 'Very Good' : 'Average'}} {{review.toFixed(0)}} / 10 </div>
            </div>
            <div class="tags-container flex">
                <div v-for="tag in bestCamping.tags" :key="tag.id" class="tag">
                    <i v-if="tag.name === 'Pool'" class="fas fa-swimmer"></i>
                    <i v-if="tag.name === 'Wifi'" class="fas fa-wifi"></i>
                    <i v-if="tag.name === 'Parking'" class="fas fa-parking"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                id: this.bestCamping.id,
                tags: [],
                review: parseInt(this.bestCamping.average_review),
            }
        },
        props: ['bestCamping']
    }
</script>