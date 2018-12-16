import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

import home from './components/Home.vue';
import login from './views/Login.vue';

export default new Router({
  mode: 'history',
  routes: [
    { path: '/', redirect: '/home' },
    { path: '/home', component: home },
    { path: '/login', component: login }
  ],
})
