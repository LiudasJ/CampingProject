import Vue from 'vue';
import VueRouter from 'vue-router';

import campsitesContainer from "./components/campsitesContainer"
import addCampsiteForm from "./components/addCampsiteForm"
import loginContainer from "./components/loginContainer"
import registerContainer from "./components/registerContainer"

Vue.use(VueRouter);

export default new VueRouter({
    base: process.env.BASE_URL,
    routes: [
        {path: '/', name: 'login', component: loginContainer },
        {path: '/register', name: 'login', component: registerContainer },
        {path: '/campings', component: campsitesContainer },
        {path: '/new', name: 'campForm', component: addCampsiteForm }
    ],
});
