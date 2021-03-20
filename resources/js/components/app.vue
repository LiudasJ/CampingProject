<template>
    <div>

    </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {
    computed: {
        ...mapGetters([
        'isLogged'
        ])
    },
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