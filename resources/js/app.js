require("./bootstrap");
import Vue from "vue";
import VueRouter from "vue-router";
import axios from "axios";
import VueAxios from "vue-axios";
import Vue2Editor from "vue2-editor";

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vue2Editor);

import App from "./App.vue";
import { routes } from "./routes";

const router = new VueRouter({
    mode: "history",
    routes: routes,
});

function loggedIn() {
    return localStorage.getItem("token");
}

const app = new Vue({
    el: "#app",
    router: router,
    render: (h) => h(App),
});
