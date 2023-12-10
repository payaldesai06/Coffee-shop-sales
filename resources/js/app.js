require('./bootstrap');
import * as Vue from 'vue';
import * as VueRouter from 'vue-router';
import App from './components/App.vue';

const Sale = () => import('./components/Sale.vue' /* webpackChunkName: "resource/js/components/sale" */)
const Shipping = () => import('./components/Shipping.vue' /* webpackChunkName: "resource/js/components/shipping" */)
const routes = [
  {
    name: 'sale',
    path: '/sales',
    component: Sale
  },
  {
    name: 'shipping',
    path: '/shipping',
    component: Shipping
  }
];

const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes,
});

Vue.createApp(App).use(router).mount('#app');
