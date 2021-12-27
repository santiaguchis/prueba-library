// Requires
window._ = require('lodash');
window.axios = require('axios');
window.Vue = require('vue');
// Imports
import Vuetify from 'vuetify';
import VueIziToast from 'vue-izitoast';
import izitoastConfig from './app/config/izitoast.js'

// Injects
Vue.use( Vuetify )
Vue.use( VueIziToast , izitoastConfig.options );

//config
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window.axios.defaults.baseURL = '/api';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
