/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

// ! Moment Js used to filter the date anc convert it to human Readable
import moment from "moment";
// !

// ! Vue Router
import VueRouter from "vue-router";

// !import vform
import { Form, HasError, AlertError } from "vform";
// * Global components for vform
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
// !

Vue.use(VueRouter);

// !Vue Progressbar
import VueProgressBar from "vue-progressbar";
Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    height: "3px"
});
// !

// ! Sweet Alart
import swal from "sweetalert2";
window.swal = swal;
// ! Sweet Alart Global
const toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", swal.stopTimer);
        toast.addEventListener("mouseleave", swal.resumeTimer);
    }
});

window.toast = toast;

// !

// !  VUE ROUTES
let routes = [
    {
        path: "/dashboard",
        component: require("./components/Dashboard.vue").default
    },
    {
        path: "/profile",
        component: require("./components/Profile.vue").default
    },
    {
        path: "/users",
        component: require("./components/Users.vue").default
    }
];

// ! Register the routes
const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

// ! Global component to make first letter upper case (this can be used anywhere in the application)
Vue.filter("upText", function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});
// ! Global component to make date human readable (this can be used anywhere in the application)
Vue.filter("myDate", function(created) {
    return moment(created).format("MMMM Do YYYY");
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router
});
