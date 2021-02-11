import VueRouter from 'vue-router';

/*************************
 *Import de componente
 ************************/

import Home from '../components/Home.vue';
import Login from '../components/Auth/Login';
import Admin from '../components/Admin/AdminDashboard';
import User from '../components/User/UserDashboard';

const router = new VueRouter({
    mode: 'history',
    routes: [

        // Route Home
        {path: '/', component: Home, name: 'home'},
        // Route Login
        {path: '/login', component: Login, name: 'login'},
        // Route Admin Dashboard
        {path: '/admin/dashboard', component: Admin, name: 'admin-dashboard'},
        // Route User Dashboard
        {path: '/user/dashboard', component: User, name: 'user-dashboard'},
    ]
});

export default router;
