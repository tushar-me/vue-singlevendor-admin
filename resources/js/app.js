import "./bootstrap"
import { createApp } from 'vue'
import {createPinia} from "pinia";
import App from './App.vue'
import 'vue-select/dist/vue-select.css';
import router from './routers/router'
import User from './helpers/User'
import Swal from "sweetalert2";
import axios from "axios";
import moment from 'moment'

import 'summernote/dist/summernote-bs4.css'
import 'summernote/dist/summernote-bs4.min.js'

window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position:'top-end',
    showConfirmButton:false,
    timer:5000,
    icon:true,
})
const isProduct = false;

import vSelect from 'vue-select'
import Uploader from 'vue-media-upload'
const app = createApp(App)
app.use(createPinia)
app.use(router)
app.use(moment)
app.component('v-select', vSelect)
app.component('Uploader', Uploader);

window.Toast = Toast
window.User = User


app.config.globalProperties.$APP_URL = import.meta.env.VITE_APP_URL
app.config.globalProperties.$FRONTEND_URL = import.meta.env.VITE_FRONTEND_URL
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
const instance = axios.create({
    withCredentials: true,
    withXSRFToken: true,
    baseURL: import.meta.env.VITE_APP_URL
});
app.config.globalProperties.$axios = instance;


app.mount( '#app')
