import { createRouter , createWebHistory } from 'vue-router'
import Dashboard from '../pages/dashboard.vue'
import Login from '../pages/login.vue'

const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router