require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

window.Vue.use(VueRouter)

const components = {};
const files = require.context('./warehouse', true, /\.vue$/i);
files.keys().map(key => {
	let name = key.split('/').pop().split('.')[0];
	components[name] = Vue.component(name, files(key).default)
});

const routes = [
    { path: '/dashboard', component: components.WarehouseDashboardFirst },
    { path: '/suppliers', component: components.Suppliers },
    { path: '/products', component: components.Products },
    { path: '/purchases', component: components.Purchases },
    { path: '/warehouses', component: components.Warehouses },
    { path: '/areas', component: components.Areas },
    { path: '/locations', component: components.Locations },
    { path: '/inventories', component: components.Inventories },
    { path: '/batch_inventories', component: components.BatchInventories }
]

const router = new VueRouter({
    routes
});

const app = new Vue({
	router,
    el: '#app'
});
