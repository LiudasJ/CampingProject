<template>
    <div class="overflow-0">
        <div @click="toggleControls()" class="burger flex flex-col relative">
            <div class="burger-item"></div>
            <div class="burger-item"></div>
            <div class="burger-item"></div>
        </div>
        <admin-nav-container :auth="auth"></admin-nav-container>
        <div class="campsite-page-wrapper flex space-between">
            <latest-campsites 
                v-on:reloadCampings="init()"
                :campings="campings"
                :auth="auth">
            </latest-campsites>
            <best-campsites-container :bestCampings="bestRated"></best-campsites-container>
        </div>
    </div>
</template>

<script>

import latestCampsites from "./latestCampsites"
import bestCampsitesContainer from "./bestCampsitesContainer"
import adminNavContainer from "./adminNavContainer"

export default {
    props: ['auth'],
    components: {latestCampsites, bestCampsitesContainer, adminNavContainer },
    data: function () {
        return {
            campings: [],
            bestRated: [],
            edit: false
        }
    },
    methods: {
        init() {
            axios.get('/init')
            .then( response => {
                console.log(response.data)
                this.campings = response.data.latestcampings.data;
                this.bestRated = response.data.topRated;
            })
            .catch(error => {
                console.log('could not fetch campings');
            })    
        },
        toggleControls() {
            const navBar = document.querySelector('.admin-nav-container');
            navBar.classList.toggle('active-nav');
        }
    },
    created() {
        this.init();
    }
}
</script>