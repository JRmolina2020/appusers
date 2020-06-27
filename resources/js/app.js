require("./bootstrap");
window.Vue = require("vue");
window.Axios = require("axios");
import store from "./store";
import SmartTable from "vuejs-smart-table";
import auth from "./mixins/Auth.js";
import LaravelPermissionToVueJS from "laravel-permission-to-vuejs";
import Swal from "sweetalert2";
window.Swal = Swal;
//start validate
import es from "vee-validate/dist/locale/es";
import VeeValidate, { Validator } from "vee-validate";
Vue.use(VeeValidate);
Validator.localize("es", es);
//end validate
//end import
//vue use
Vue.use(SmartTable);
Vue.use(LaravelPermissionToVueJS);
Vue.mixin(auth);
//end use
Vue.component("login", require("./components/login.vue").default);
Vue.component("users", require("./components/users/index.vue").default);
Vue.component("roles", require("./components/roles/index.vue").default);
Vue.component(
    "permissions",
    require("./components/permissions/index.vue").default
);
Vue.component("home_app", require("./components/indicatorHome.vue").default);
Vue.component("profile", require("./components/users/profile.vue").default);
const app = new Vue({
    el: "#app",
    store
});
