require('./bootstrap');

import Vue from 'vue';
import router from './router';
import store from './store';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';

Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    router,
    store
});
