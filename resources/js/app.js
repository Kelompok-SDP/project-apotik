/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import dependecies tambahan
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';
Vue.use(VueRouter,VueAxios,Axios);

import App from './components/App.vue';
import Test from './components/admin/Test.vue';
import Kategori from './components/admin/Kategori.vue';



// membuat router
const routes = [
    {
        name: 'test',
        path: '/',
        component: Test
    },
    {
        name: 'Kategori',
        path: '/admin/kategori',
        component: Kategori
    },
]

const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");