import { createRouter, createWebHistory } from "vue-router";

import login from '../components/auth/login.vue' 
import register from '../components/auth/register.vue' 
import survey from '../components/survey/index.vue' 

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
    
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some((x) => x.meta.auth);
    const requiresGuest = to.matched.some((x) => x.meta.requiresGuest);
  
    let routerAuthCheck = false;
  
    if (localStorage.getItem('token') && localStorage.getItem('expires_at')) {
      const expiresAt = localStorage.getItem('expires_at') ? localStorage.getItem('expires_at') : 0;
      routerAuthCheck = new Date().getTime() < expiresAt;
    }
  
    if (requiresAuth) {
      if (!routerAuthCheck) {
        next({ name: "login" })
      }
    }
  
    if (requiresGuest && routerAuthCheck) {  
        next({ name: "survey" }); 
    }
    next();
  })

  export default router;