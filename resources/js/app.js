/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
// import router from './router'
// import App from './components/app'
import store from './store'

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('campsite', require('./components/Campsite.vue').default);
Vue.component('rating-component', require('./components/Ratings.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    // components: { App },
    // router,
    // store,
    // created () {
    //     const userInfo = localStorage.getItem('user')
    //     if (userInfo) {
    //       const userData = JSON.parse(userInfo)
    //       this.$store.commit('setUserData', userData)
    //     }
    //     axios.interceptors.response.use(
    //       response => response,
    //       error => {
    //         if (error.response.status === 401) {
    //           this.$store.dispatch('logout')
    //         }
    //         return Promise.reject(error)
    //       }
    //     )
    //   },
    //   render: h => h(App)
});


const campCards = document.querySelectorAll('.welcome-camp-card');
const campCardsCount = document.querySelectorAll('.welcome-camp-card').length;
const controls = document.querySelectorAll('.carousel-controls');
const carousel = document.querySelector('.cards-container');

let cardIndex = 4;
let translateX = 0;

controls.forEach(arrow => {
    arrow.addEventListener('click', (e) => {
        var transition;
        if (e.target.id === 'prev') {
            if (cardIndex !== 4) {
                cardIndex--
                translateX += 250;
            }
        } else {
            if (cardIndex !== campCardsCount) {
                cardIndex++;
                translateX -= 250
            }
        }

        carousel.style.transform = `translateX(${translateX}px)`
    })
})