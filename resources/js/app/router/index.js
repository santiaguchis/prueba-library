import Vue from 'vue'
import VueRouter from 'vue-router';
import store from '../store/index';
// Layout
import PublicLayout from '../components/layouts/Public';
import MainLayout from '../components/layouts/Main';
//Routing
import AppRouting from './routing';
//Other Pages
import LoginPage from '../views/auth/pages/LoginPage';
// Injects
Vue.use( VueRouter )

// const
const routes = [
    {
        path : '*',
        redirect : '/',
    },
    {
        path : '/auth',
        component : PublicLayout,
        meta: { guest: true },
        children : [
            {
                path        : 'login',
                name        : 'auth.login',
                component   : LoginPage
            }
        ]
    },
    {
        path : '',
        meta : { requiresAuth : true },
        component : MainLayout,
        children: [
            ...AppRouting
        ]
    }
]
const router = new VueRouter({
    mode: 'history',
	history : true,
    routes
})

router.beforeEach((to, from, next) => {
        if ( to.matched.some( (record) => record.meta.requiresAuth ) ) {
        if ( store.state.Auth.user ) {
            next();
            return;
        }
        console.warn( 'Usuario no está autenticado' )
        next({ name: 'auth.login'});
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if ( to.matched.some( (record) => record.meta.guest ) ) {
        if ( store.state.Auth.user ) {
            console.log( 'Usuario ya está autenticado redireccionado al dashboard' )
            next({ name: 'home' });
            return;
        }
        next();
    } else {
        next();
    }
});

export default router
