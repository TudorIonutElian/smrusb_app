import VueRouter from 'vue-router';

/*************************
 *Import de componente
 ************************/

import Admin from '../components/Admin/AdminDashboard';
import CreareStat from "../components/Admin/Stat/CreareStat";


import Home from '../components/Home.vue';
import Login from '../components/Auth/Login';
import Register from '../components/Auth/Register';

import User from '../components/User/UserDashboard';
import ActivareUtilizatori from '../components/Admin/ActivareUtilizatori';
import UserPannelControl from '../components/User/UserPannelControl';
import UserChangePassword from '../components/User/UserChangePassword';

import AdaugaAngajat from '../components/User/Management/AdaugareAngajat';
import MutareAngajat from "../components/User/Management/MutareAngajat";
import SolicitareAcces from '../components/User/Management/SolicitareAcces';



import NomenclatorRegiuni from '../components/Admin/Nomenclator/Regiuni';
import NomenclatorJudete from '../components/Admin/Nomenclator/Judete';
import Angajat from "../components/User/Angajat/Angajat";
import VizualizareStat from "../components/User/Stat/VizualizareStat";
import AccesUtilizatori from "../components/Admin/AccesUtilizatori";
import MutareAngajatSelectat from "../components/User/Management/MutareAngajatSelectat";
import SuplimentareStat from "../components/User/Stat/SuplimentareStat";


const router = new VueRouter({
    mode: 'history',
    routes: [
        // Route Home
        {path: '/', component: Home, name: 'home'},
        {path: '/despre', component: Home, name: 'despre'},

        // Route Admin Dashboard
        {path: '/admin/dashboard', component: Admin, name: 'admin-dashboard'},
        {path: '/admin/stat/creare', component: CreareStat, name: 'creare-stat'},



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
        {path: '/user/mutare_angajat', component: MutareAngajat, name: 'mutare-angajat'},
        {path: '/user/mutare_angajat/:id', component: MutareAngajatSelectat, name: 'mutare-angajat-selectat'},




        {path: '/user/solicitare_acces/:id', component: SolicitareAcces, name: 'solicitare-acces'},
        {path: '/user/stat/vizualizare', component: VizualizareStat, name: 'vizualizare-stat'},
        {path: '/user/stat/suplimentare', component: SuplimentareStat, name: 'suplimentare-stat'},



        // Rute pentru admin nomenclator
        {path: '/admin/nomenclator/regiuni', component: NomenclatorRegiuni, name: 'nomenclator-regiuni'},
        {path: '/admin/nomenclator/judete', component: NomenclatorJudete, name: 'nomenclator-judete'},








        {path: '/admin/utilizatori/access', component: AccesUtilizatori, name: 'utilizatori-acces'},


        // Rute pentru angajati
        {path: '/angajat/:id', component: Angajat, name: 'angajat'},
    ]
});

export default router;
