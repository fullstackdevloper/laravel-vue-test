import { createRouter, createWebHistory } from "vue-router";

import login from '../components/auth/login.vue' 
import register from '../components/auth/register.vue' 
import survey from '../components/dashboard/index.vue' 
import result from '../components/dashboard/result.vue' 

const routes = [
    {
        path: '/login',
        name: 'login',
        component: login,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: register,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/survey',
        name: 'survey',
        component: survey,
        meta: {
            auth: true
        }
    },
    {
        path: '/result',
        name: 'result',
        component: result,
        meta: {
            auth: true
        }
    },
    
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some((x) => x.meta.auth);
    const requiresGuest = to.matched.some((x) => x.meta.requiresGuest);
  
    let tokenExpired = true;
  
    if (localStorage.getItem('token') && localStorage.getItem('expires_at')) {
      const expiresAt = localStorage.getItem('expires_at') ? localStorage.getItem('expires_at') : 0;
      tokenExpired = new Date().getTime() >= new Date(expiresAt).getTime();
    }
  
    if (requiresAuth) {
      if (tokenExpired) {
        localStorage.removeItem('token')
        localStorage.removeItem('expires_at')
        next({ name: "login" })
      }
    }
  
    if (requiresGuest && !tokenExpired) {
        next({ name: "survey" }); 
    }
    next();
  })

  export default router;