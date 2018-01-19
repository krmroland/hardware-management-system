import "./bootstrap";

import "./components";

import helpers from "./mixins/helpers";

//import router from "./routes";

const app = new Vue({
    el: "#app",
    mixins: [helpers]
    //router,
});
