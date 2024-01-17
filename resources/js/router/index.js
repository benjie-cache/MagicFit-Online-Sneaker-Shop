// src/router.js
import {createRouter,createWebHistory} from 'vue-router';

import { ElLoading } from 'element-plus';
import { useAuthStore } from '@/store/authStore.js';
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { ElNotification } from 'element-plus';
const Home=()=>import('@/pages/Home.vue');

const Shop=()=>import('@/pages/Shop.vue');
const Checkout=()=>import('@/pages/Checkout.vue')
const Login=()=>import('@/pages/auth/Login.vue');
const Register=()=>import('@/pages/auth/Register.vue');
const Cart=()=>import('@/pages/Cart.vue');
const NotFound=()=>import('@/pages/404.vue');
const Account=()=>import('@/pages/Account.vue');
const Wishlist=()=>import('@/pages/Wishlist.vue');
const showNotification = (title, message, type) => {
  ElNotification({
    title,
    message,
    type,
  });
};
const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: DefaultLayout,
      children: [
        { path: '/', component: Home, name: 'home', meta: { title: 'MagicFit || Home' } },
        { path: '/shop', component: Shop, name: 'shop',  meta: { title: 'MagicFit || Shop' }},

        { path: '/checkout',
         component: Checkout,
          name:'checkout',
         meta: { title: 'MagicFit || Checkout',
             requiresAuth: true },
          props: route => ({ pid: route.query.pid }) 
        },
        { path: '/account', component: Account, name:'account' ,meta: { title: 'MagicFit || Customer Account' }},
        { path: '/cart', component: Cart, name:'cart' ,meta: { title: 'MagicFit || Cart' }},
        { path: '/wishlist', component: Wishlist, name:'wishlist' ,meta: { title: 'MagicFit || WishList' }},
      ],
    },
    { path: '/login', component: Login, name: 'login',meta: { title: 'MagicFit || Customer Login' } },
    { path: '/register', component: Register, name: 'register' ,meta: { title: 'MagicFit || Customer Register' }},
    { path: '/:pathMatch(.*)*', component: NotFound, name: 'not-found',meta: { title: 'MagicFit || Page Not Found' } },
  ],
});
// Set up a navigation guard to update the document title on each route change and also to checl whether a route requires login
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  if (to.matched.some(record => record.meta.requiresAuth) && !authStore.user) {
    next({ name: 'login' ,
    params: { nextUrl: to.fullPath },
     });
     showNotification('Login First','You have to be logged in to access that {}..','warning')
  } 
  const loadingInstance = ElLoading.service({ fullscreen: true});
  document.title = to.meta.title || 'MagicFit';
  next();
});
router.afterEach(() => {
  ElLoading.service().close();
});


export default router;


