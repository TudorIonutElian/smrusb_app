/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router';
import router from './router/router';

window.Vue = require('vue').default;
Vue.use(VueRouter)

import Vuex from 'vuex'
Vue.use(Vuex)

import Notifications from 'vue-notification';
Vue.use(Notifications)

import VueToast from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast, {
    // One of the options
    position: 'bottom-right'
});

//Vue.$toast.open({/* options */});
let instance = Vue.$toast.open('You did it!');

// Force dismiss specific toast
instance.dismiss();
// Dismiss all opened toast immediately
Vue.$toast.clear();


import store from './vuex/store';

const app = new Vue({
    el: '#app',
    router,
    store
});
