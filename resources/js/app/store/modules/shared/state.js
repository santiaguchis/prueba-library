export default {
    page : {
        title : 'Admin - Suriflowers',
        header : 'Suriflowers',
        section : 'Inicio',
        version : '0.1.0',
        loading : false,
        logout : false,
        sidebar : {
            mini : false
        },
        process : false
    },
    menu : [
        {
            icon : 'mdi-monitor-dashboard',
            text : 'Dahsboard',
            exact : true,
            to : {
                name : 'home'
            }
        },
        {
            icon : 'mdi-warehouse',
            text : 'Inventario',
            exact : false,
            to : {
                name : 'inventory'
            }
        },
        {
            icon : 'mdi-clipboard-list',
            text : 'Movimientos',
            exact : false,
            to : {
                name : 'movements'
            }
        },
        {
            icon : 'mdi-basket',
            text : 'Ordenes',
            exact : false,
            to : {
                name : 'orders'
            }
        },
        {
            icon : 'mdi-account-group',
            text : 'Usuarios',
            exact : false,
            to : {
                name : 'users'
            }
        }
    ]
}
