import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

import home from './views/Home.vue';
import login from './views/Login.vue';
import signup from './views/Signup.vue';
import thread from './views/Thread.vue';
import threadList from './views/ThreadList.vue';

export default new Router({
  mode: 'history',
  routes: [
    { path: '/', redirect: '/home' },
    { path: '/home', component: home },
    { path: '/login', component: login },
    { path: '/signup', component: signup },
    { path: '/thread/:threadId', component: thread },
    { path: '/thread-list', component: threadList }
  ],
})
