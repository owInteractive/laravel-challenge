
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Login from "./components/Login.vue"
import Register from "./components/Register.vue";

import Home from "./components/Home.vue";

import Account from "./components/Account.vue";
import Today from "./components/Today.vue";
import NewEvent from "./components/NewEvent.vue";


const app = new Vue({
    el: '#app',
    components: {Login, Register, Home, Account, Today, NewEvent},
});