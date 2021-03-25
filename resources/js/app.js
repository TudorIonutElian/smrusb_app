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


import store from './vuex/store';

const app = new Vue({
    el: '#app',
    router,
    store
});
