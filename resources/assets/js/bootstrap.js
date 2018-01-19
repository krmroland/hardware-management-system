import lodash from "lodash";

import Vue from "vue";

import Confirmation from "./Confirmation";

window._ = lodash;

window.axios = require("axios");

window.Vue = Vue;

window.events = new Vue();

window.flash = function(message, type = "success") {
    window.events.$emit("flash", { message, type });
};

window.Confirmation = Confirmation;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

let token = document.head.querySelector('meta[name="csrf-token"]');
window.csrf_token = token.content;
axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
axios.interceptors.response.use(
    function(response) {
        // Do something with response data
        return response;
    },
    function(error) {
        if (error.hasOwnProperty("message")) {
            flash(error.message, "danger");
        }
        return Promise.reject(error);
    }
);
