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
import UserPannelControl from '../components/User/UserPannelControl';
import UserChangePassword from '../components/User/UserChangePassword';
import AdaugaAngajat from '../components/User/Management/AdaugareAngajat';



import NomenclatorRegiuni from '../components/Admin/Nomenclator/Regiuni';

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Route Home
        {path: '/', component: Home, name: 'home'},
        {path: '/despre', component: Home, name: 'despre'},

        // Route Admin Dashboard
        {path: '/admin/dashboard', component: Admin, name: 'admin-dashboard'},
        // Route User Dashboard
        {path: '/user/dashboard', component: User, name: 'user-dashboard'},

        {path: '/utilizatori/activare', component: ActivareUtilizatori, name: 'utilizatori-activare'},
        {path: '/user/profile/:id', component: UserPannelControl, name: 'utilizatori-panou-control'},
        {path: '/user/changepassword/:id', component: UserChangePassword, name: 'utilizatori-schimba-parola'},

        /*--- User Routes*/
        /*--- User Routes --- Route Login */
        {path: '/login', component: Login, name: 'login'},
        /*--- User Routes --- Route Inregistrare */
        {path: '/inregistrare', component: Register, name: 'register'},
        /*--- User Routes --- Route Management Resurse - Adauga angajat */
        {path: '/user/adauga_angajat', component: AdaugaAngajat, name: 'adauga-angajat'},


        // Rute pentru admin nomenclator
        {path: '/admin/nomenclator/regiuni', component: NomenclatorRegiuni, name: 'nomenclator-regiuni'},
    ]
});

export default router;
