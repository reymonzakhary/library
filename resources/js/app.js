/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';

import HeaderLogin from './components/HeaderLogin'
import Login from './components/Login'
import Register from './components/Register'

const routes = [
    {path:'/Login' , component:Login},
    {path:'/Register' , component:Register}

]
const router = VueRouter({
    routes
});
Vue.use(VueRouter)
const app = new Vue({
    el: '#app',
    router: router,
    components:{
        HeaderLogin
    }
});
