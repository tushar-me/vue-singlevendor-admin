import Vue from 'vue'
import router from './routers/router'
import User from './helpers/User'
import Swal from "sweetalert2";
import axios from "axios";
import moment from 'moment'
Vue.use(moment)
Vue.filter('dateFormat', function (value){
    if (value){
        return moment(String(value)).format("MMM Do YY");
    }
})

window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position:'top-end',
    showConfirmButton:false,
    timer:5000,
    icon:true,
})
window.Toast = Toast
window.User = User
window.axios = axios

window.Reload = new Vue;

const appVue2 = new Vue({
    el: '#app',
    router
});




