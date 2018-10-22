
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// Vue.component('example', require('./components/Example.vue'));
// Vue.component('home', require('./components/Home.vue'));

// const app = new Vue({
//     el: '#app'
// });


//app.js

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';

import App from './App.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Products from './components/Products.vue';
import InfoProduct from './components/InfoProduct.vue';
import CartProducts from './components/CartProducts.vue';
import ChitietDonhang from './components/ChitietDonhang.vue';
import ListsDonhang from './components/ListsDonhang.vue';
import InfoDonhang from './components/InfoDonhang.vue';
import StateDonhang from './components/StateDonhang.vue';
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
const routes = [
    {
        name:'Products',
        path: '/', 
        component: Products,
        // props: { 
        //     user: "Skipperhoa",
        //     author : {
        //         name : "Fisayo Afolayan",
        //         role : "Software Engineer",
        //         code : "Always keep it clean"
        //     }
        // }
    },
    {
        name:'InfoProduct',
        path:'/info-product/:id',
        component:InfoProduct
    },
    {
        name:'CartProducts',
        path:'/cart-products',
        component:CartProducts,
        meta: {
            auth: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/chi-tiet-don-hang',
        name: 'chitietdonhang',
        component: ChitietDonhang,
        meta: {
            auth: true
        }
    },
    {
        path: '/list-don-hang',
        name:'ListsDonhang',
        component: ListsDonhang,
        meta: {
            auth:true
        }
    },
    {
        path: '/thong-tin-chi-tiet',
        name:'InfoDonhang',
        component: InfoDonhang,
        meta:{
            auth:true
        }
    },
    {
        path: '/tinh-trang-don-hang',
        name:'StateDonhang',
        component:StateDonhang,
        meta:{
            auth:true
        }
    }
]
const router = new VueRouter({mode:'history', routes: routes});
Vue.router=router
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
new Vue(Vue.util.extend({router,store},App)).$mount('#app');


 