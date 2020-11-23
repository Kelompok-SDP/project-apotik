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
// axios.defaults.xsrfHeaderName = 'X-CSRFToken'
Vue.use(VueRouter,VueAxios,Axios);

import App from './components/App.vue';
import Admin from './components/Admin.vue';
import PageNotFound from './components/PageNotFound.vue';


import Login from './components/user/login&register/Login.vue';
import Register from './components/user/login&register/Register.vue';

import Home from './components/user/Homepage/Home.vue';
import Artikel from './components/user/Homepage/Artikel.vue';
import ArtikelPage from './components/user/Artikel/ArtikelPage.vue';
import DetailArPage from './components/user/Artikel/DetailArtikel.vue';
import ObatPage from './components/user/Obat/ObatPage';
import AlatPage from './components/user/Alat/AlatPage';
import KategoriPage from './components/user/Obat/KategoriPage';
import AlatKategoriPage from './components/user/Alat/AlatKategoriPage';
import TagPage from './components/user/Artikel/TagPage';
import Profil from './components/user/Homepage/Profil.vue';
import CartPage from './components/user/Cart/CartPage.vue'
import DetailObat from './components/user/Obat/DetailObat.vue'
import NotifPage from './components/user/NotifPage/NotifPage.vue'

// membuat router
const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home
    },
    {
        name: 'Artikel',
        path: '/artikel',
        component: Artikel
    },
    {
        name: 'ArtikelPage',
        path: '/artikelpage',
        component: ArtikelPage
    },
    {
        name: 'DetailArPage',
        path: '/artikelpage/artikel/:slug',
        component: DetailArPage
    },
    {
        name: 'ObatPage',
        path: '/produk',
        component: ObatPage
    },
    {
        name: 'AlatPage',
        path: '/alat/produk',
        component: AlatPage
    },
    {
        name: 'KategoriPage',
        path: '/produk/:slug',
        component: KategoriPage
    },
    {
        name: 'AlatKategoriPage',
        path: '/alat/produk/:slug',
        component: AlatKategoriPage
    },
    {
        name: 'TagPage',
        path: '/artikelpage/:id',
        component: TagPage
    },
    {
        name: 'DetailObat',
        path: '/obat/:id',
        component: DetailObat
    },
    {
        name: 'CartPage',
        path: '/lihatCart',
        component: CartPage
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
        name: 'Profil',
        path: '/profilUser',
        component: Profil
    },
    {
        name: 'Profil',
        path: '/profilUser',
        component: Profil
    },
    {
        name: 'NotifPage',
        path: '/notifpage',
        component: NotifPage
    },
    {
        name: 'PageNotFound',
        path: '*',
        component: PageNotFound
    },

]

const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");

