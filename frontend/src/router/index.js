import { createRouter , createWebHistory } from 'vue-router'
import store from '../store/index.js'
import Dashboard from '../pages/Dashboard.vue'
import Login from '../pages/Login.vue'
import RequestPassword from '../pages/RequestPassword.vue'
import ResetPassword from '../pages/ResetPassword.vue'
import NotFound from '../pages/NotFound.vue'
import AppLayout from '../components/AppLayout.vue'
import Product from '../pages/Products/Product.vue'
import Order from '../pages/Order.vue'
import Customer from '../pages/Customer.vue'
import User from '../pages/User.vue'

const routes = [
    {
        path: '/app',
        name: 'app',
        component: AppLayout,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/dashboard',
                name: 'app.dashboard',
                component: Dashboard
            },
            {
                path: '/product',
                name: 'app.products',
                component: Product
            },
            {
                path: '/order',
                name: 'app.orders',
                component: Order
            },
            {
                path: '/customer',
                name: 'app.customers',
                component: Customer
            },
            {
                path: '/user',
                name: 'app.users',
                component: User
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/request-password',
        name: 'requestPassword',
        component: RequestPassword,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/reset-password',
        name: 'resetPassword',
        component: ResetPassword,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/:pathMatch(.*)',
        name: 'notfound',
        component: NotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to,from,next) => {
    if(to.meta.requiresAuth && !store.state.user.token) {
        next({name:'login'});
    } else if(to.meta.requiresGuest && store.state.user.token) {
        next({name:'app.dashboard'})
    } else {
        next()
    }
})

export default router