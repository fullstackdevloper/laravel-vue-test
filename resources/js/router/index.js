import { createRouter, createWebHistory } from "vue-router";

import login from '../components/auth/login.vue' 
import register from '../components/auth/register.vue' 

const routes = [
    {
        path: '/login',
        name: 'login',
        component: login
    },
    {
        path: '/register',
        name: 'register',
        component: register
    },
    
]

export default createRouter({
    history: createWebHistory(),
    routes
})