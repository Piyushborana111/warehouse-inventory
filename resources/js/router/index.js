import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../pages/Dashboard.vue';
import Users from '../pages/users/UserList.vue';
import UserForm from '../pages/users/UserForm.vue';
import WarehouseList from '../pages/warehouses/WarehouseList.vue';
import WarehouseForm from '../pages/warehouses/WarehouseForm.vue';
import ProductList from '../pages/products/ProductList.vue';
import ProductForm from '../pages/products/ProductForm.vue';

const routes = [
    { path: '/', component: Dashboard},
    { path: '/users', component: Users },
    { path: '/users/create', component: UserForm },
    { path: '/users/:id/edit', component: UserForm, props: true },
    { path: '/warehouses', component: WarehouseList },
    { path: '/warehouses/create', component: WarehouseForm },
    { path: '/warehouses/:id/edit', component: WarehouseForm, props: true },
    { path: '/products', component: ProductList },
    { path: '/products/create', component: ProductForm },
    { path: '/products/:id/edit', component: ProductForm, props: true },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
