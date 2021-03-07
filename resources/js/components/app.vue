<template>
    <div>
        <site-header
            v-show="$route.name!=='login'"
            :auth="isLogged"
            v-on:loggedOut="logout()">
        </site-header>
        <router-view :auth="isLogged"></router-view>
        <footer-container v-show="$route.name!=='login' && $route.name!=='campForm'"></footer-container>
    </div>
</template>

<script>

import siteHeader from "./siteHeader"
import footerContainer from "./footerContainer"

import { mapGetters } from 'vuex'

export default {
    computed: {
        ...mapGetters([
        'isLogged'
        ])
    },
    components: {siteHeader, footerContainer},
    methods: {
        logout () {
            this.$router.push({ path : '/' }); 
            this.$store.dispatch('logout')
        }
    },
    created() {
    }
}
</script>