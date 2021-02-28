import VueRouter from 'vue-router';

/*************************
 *Import de componente
 ************************/

import Home from '../components/Home.vue';
import Login from '../components/Auth/Login';
import Register from '../components/Auth/Register';
import Admin from '../components/Admin/AdminDashboard';
import User from '../components/User/UserDashboard';
import ActivareUtilizatori from '../components/Admin/ActivareUtilizatori';

const router = new VueRouter({
    mode: 'history',
    routes: [

        // Route Home
        {path: '/', component: Home, name: 'home'},

        {path: '/despre', component: Home, name: 'despre'},
        // Route Login
        {path: '/login', component: Login, name: 'login'},

        // Route Register
        {path: '/inregistrare', component: Register, name: 'register'},

        // Route Admin Dashboard
        {path: '/admin/dashboard', component: Admin, name: 'admin-dashboard'},
        // Route User Dashboard
        {path: '/user/dashboard', component: User, name: 'user-dashboard'},


        {path: '/utilizatori/activare', component: ActivareUtilizatori, name: 'utilizatori-activare'},
    ]
});

export default router;
