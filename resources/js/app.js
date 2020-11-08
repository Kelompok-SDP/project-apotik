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
import Admin from './components/Admin.vue';
import PageNotFound from './components/PageNotFound.vue';


import Login from './components/user/login&register/Login.vue';
import Register from './components/user/login&register/Register.vue';

import Home from './components/user/Homepage/Home.vue'

// membuat router
const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home
    },
    {
        name: 'Register',
        path: '/register',
        component: Register
    },
    {
        name: 'Login',
        path: '/login',
        component: Login
    },
    {
        name: 'Admin',
        path: '/admin',
        component: Admin
    },
    
    {
        name: 'PageNotFound',
        path: '*',
        component: PageNotFound
    },

]
const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");

