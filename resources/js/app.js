/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Profile from "./components/Profile.vue";
import Dashboard from "./components/Dashboard.vue";
import Users from "./components/Users.vue";
import moment from 'moment';



require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Import vue progress bar class from vue-progressbar library
import VueProgressBar from 'vue-progressbar';
// Use progress bar in application globally and create style for progressbar
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

// Import sweetalert
import swal from 'sweetalert2';
window.swal = swal;
// Register toast for create user
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;


let routes = [
    {
        path: "/dashboard",
        component: Dashboard
    },
    {
        path: "/profile",
        component: Profile
    },
    {
        path: "/users",
        component: Users
    }
]

const router = new VueRouter({
    mode: "history",
    routes
})

Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('dateFilter', function(createdAt) {
    return moment(createdAt).format('MMMM Do YYYY');
});

// With this piece of code we van crate custome events
window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
