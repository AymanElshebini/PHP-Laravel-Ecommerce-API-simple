import './bootstrap';
import { createApp } from 'vue';
import app from './app.vue';
import 'bootstrap/dist/css/bootstrap.rtl.css';
import 'bootstrap/dist/css/bootstrap.rtl.css';
import LoadingPlugin from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import '../../public/css/backend.css';
//import 'jquery/dist/jquery.min.js';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap/dist/js/bootstrap.bundle.js';
import vue3editor from 'vue3-editor';
import axios from 'axios';
import router from './router';
import swal from 'sweetalert2';
import LaravelVuePagination from 'laravel-vue-pagination';


const myapp = createApp(app);
window.Swal = swal;
myapp.config.globalProperties.$axios = axios;
myapp.component('Pagination',LaravelVuePagination );
myapp.use(router);
myapp.use(LoadingPlugin);
myapp.use(vue3editor);
myapp.mount('#app');