require('./bootstrap');

import Vuetify from 'vuetify';
import router from './app/router/index';
import vuetifyConfig from './app/config/theme'
import interceptors from './app/config/interceptors'
import store from './app/store/index';

export default new Vuetify({
    theme: vuetifyConfig.theme,
})
Vue.component('app-layout', require('./app/App.vue').default);

const app = new Vue({
    el: '#app',
    store,
    vuetify: new Vuetify(),
    router,
    created : interceptors
});
