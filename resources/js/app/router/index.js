import Vue from 'vue'
import VueRouter from 'vue-router';
import store from '../store/index';
// Layout
import PublicLayout from '../modules/Shared/layouts/Public';
import MainLayout from '../modules/Shared/layouts/Main';
//Modules
import AppRouting from './routing';
import AuthRouting from '../modules/Auth/routing';
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
            ...AuthRouting
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
