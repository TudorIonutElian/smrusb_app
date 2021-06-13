import VueRouter from 'vue-router';

/*************************
 *Import de componente
 ************************/

import Admin from '../components/Admin/AdminDashboard';
import CreareStat from "../components/Admin/Stat/CreareStat";
import ModificareStat from "../components/Admin/Stat/ModificareStat";
import ModificareStatSelectat from "../components/Admin/Stat/ModificareStatSelectat";


import Home from '../components/Home.vue';
import Login from '../components/Auth/Login';
import Register from '../components/Auth/Register';

import User from '../components/User/UserDashboard';
import ActivareUtilizatori from '../components/Admin/ActivareUtilizatori';
import UserPannelControl from '../components/User/UserPannelControl';
import UserChangePassword from '../components/User/UserChangePassword';

import AdaugaAngajat from '../components/User/Management/AdaugareAngajat';
import MutareAngajat from "../components/User/Management/MutareAngajat";
import MutareAngajatSelectat from "../components/User/Management/MutareAngajatSelectat";
import NumireAngajat from "../components/User/Management/NumireAngajat";
import NumireAngajatSelectat from "../components/User/Management/NumireAngajatSelectat";


import SolicitareAcces from '../components/User/Management/SolicitareAcces';

import NomenclatorRegiuni from '../components/Admin/Nomenclator/Regiuni';
import NomenclatorJudete from '../components/Admin/Nomenclator/Judete';
import NomenclatorLocalitati from '../components/Admin/Nomenclator/Localitati';
import NomenclatorInstitutii from '../components/Admin/Nomenclator/Institutii';

import Angajat from "../components/User/Angajat/Angajat";
import IncetareAngajat from "../components/User/Management/IncetareAngajat";
import VizualizareStat from "../components/User/Stat/VizualizareStat";
import AccesUtilizatori from "../components/Admin/AccesUtilizatori";

import SuplimentareStat from "../components/User/Stat/SuplimentareStat";
import CuprinsStat from "../components/User/Stat/CuprinsStat";
import RadiereStat from "../components/User/Stat/RadiereStat";
import VacanteStat from "../components/User/Stat/VacanteStat";


import GenerareSalarii from "../components/User/Salarii/GenerareSalarii";
import VizualizareSalarii from "../components/User/Salarii/VizualizareSalarii";
import AdaugarePontaj from "../components/User/Pontaj/AdaugarePontaj";
import VizualizarePontajUser from "../components/User/Pontaj/VizualizarePontajUser";
import DatePlata from "../components/User/Angajat/DatePlata";
import IncetareAngajatSelectat from "../components/User/Management/IncetareAngajatSelectat";
import AdreseAngajat from "../components/User/Angajat/AdreseAngajat";
import AngajatiAprobareContUser from "../components/User/Management/AngajatiAprobareContUser";
import AprobarePontaj from "../components/User/Pontaj/AprobarePontaj";
import EvaluareVizualizare from "../components/User/Evaluare/EvaluareVizualizare";
import EvaluareAdaugare from "../components/User/Evaluare/EvaluareAdaugare";
import EvaluareAdaugareSelectat from "../components/User/Evaluare/EvaluareAdaugareSelectat";
import IncetariContracte from "../components/User/Situatii/IncetariContracte";
import MutariPersonal from "../components/User/Situatii/MutariPersonal";
import DespreComponent from "../components/DespreComponent";
import AngajatCalificative from "../components/User/Angajat/AngajatCalificative";
import EvaluareAprobare from "../components/User/Evaluare/EvaluareAprobare";
import SalariiLunare from "../components/User/Situatii/SalariiLunare";
import AdeverintaAngajat from "../components/User/Adeverinte/AdeverintaAngajat";
import AdeverintaAsigurat from "../components/User/Adeverinte/AdeverintaAsigurat";
import AdeverintaSalarii from "../components/User/Adeverinte/AdeverintaSalarii";
import SalariiSemestriale from "../components/User/Situatii/SalariiSemestriale";
import SalariiTrimestriale from "../components/User/Situatii/SalariiTrimestriale";
import SalariiAnuale from "../components/User/Situatii/SalariiAnuale";
import CassNeachitat from "../components/User/Situatii/CassNeachitat";
import CassAchitat from "../components/User/Situatii/CassAchitat";
import EvaluareContestatii from "../components/User/Evaluare/EvaluareContestatii";
import RecompenseAdaugare from "../components/User/Recompense/RecompenseAdaugare";
import SanctiuniAdaugare from "../components/User/Sanctiuni/SanctiuniAdaugare";

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Route Home
        {path: '/', component: Home, name: 'home'},
        {path: '/despre', component: DespreComponent, name: 'despre'},

        // Route Admin Dashboard
        {path: '/admin/dashboard', component: Admin, name: 'admin-dashboard'},
        {path: '/admin/stat/creare', component: CreareStat, name: 'creare-stat'},
        {path: '/admin/stat/modificare', component: ModificareStat, name: 'modificare-stat'},
        {path: '/admin/stat/modificare/:id', component: ModificareStatSelectat, name: 'modificare-stat-selectat'},



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
        {path: '/user/angajat/incetare_angajat', component: IncetareAngajat, name: 'incetare-angajat'},
        {path: '/user/angajat/incetare_angajat/:id', component: IncetareAngajatSelectat, name: 'incetare-angajat-selectat'},
        {path: '/user/angajati/aprobare/:id', component: AngajatiAprobareContUser, name: 'user-angajat-aprobare'},


        {path: '/user/numire_angajat', component: NumireAngajat, name: 'numire-angajat'},
        {path: '/user/numire_angajat/:id', component: NumireAngajatSelectat, name: 'numire-angajat-selectat'},




        {path: '/user/solicitare_acces/:id', component: SolicitareAcces, name: 'solicitare-acces'},
        {path: '/user/stat/vizualizare', component: VizualizareStat, name: 'vizualizare-stat'},
        {path: '/user/stat/suplimentare', component: SuplimentareStat, name: 'suplimentare-stat'},
        {path: '/user/stat/cuprins', component: CuprinsStat, name: 'cuprins-stat'},
        {path: '/user/stat/radiere', component: RadiereStat, name: 'radiere-stat'},
        {path: '/user/stat/vacante', component: VacanteStat, name: 'vacante-stat'},


        {path: '/user/dashboard/calificativeangajat/:id', component: AngajatCalificative, name: 'angajat-calificative'},
        {path: '/user/adeverinte/adeverintaangajat', component: AdeverintaAngajat, name: 'adeverinta-angajat'},
        {path: '/user/adeverinte/adeverintaasigurat', component: AdeverintaAsigurat, name: 'adeverinta-asigurat'},
        {path: '/user/adeverinte/adeverintasalarii', component: AdeverintaSalarii, name: 'adeverinta-salarii'},



        {path: '/user/salarii/generare', component: GenerareSalarii, name: 'generare-salarii'},
        {path: '/user/salarii/vizualizare', component: VizualizareSalarii, name: 'vizualizare-salarii'},

        {path: '/user/angajat/pontaj/creare', component: AdaugarePontaj, name: 'adaugare-pontaj'},
        {path: '/user/pontaj/vizualizare', component: VizualizarePontajUser, name: 'vizualizare-pontaj-user'},
        {path: '/user/pontaj/aprobare', component: AprobarePontaj, name: 'aprobare-pontaj-user'},


        {path: '/user/evaluare/vizualizare', component: EvaluareVizualizare, name: 'evaluare-vizualizare'},
        {path: '/user/evaluare/adaugare', component: EvaluareAdaugare, name: 'evaluare-adaugare'},
        {path: '/user/evaluare/adaugare/:id', component: EvaluareAdaugareSelectat, name: 'evaluare-adaugare-selectat'},
        {path: '/user/evaluare/aprobare', component: EvaluareAprobare, name: 'evaluare-aprobare'},
        {path: '/user/evaluare/contestatii', component: EvaluareContestatii, name: 'evaluare-contestatii'},

        {path: '/user/recompense/adaugare', component: RecompenseAdaugare, name: 'recompense-adaugare'},
        {path: '/user/sanctiuni/adaugare', component: SanctiuniAdaugare, name: 'sanctiuni-adaugare'},


        {path: '/user/situatii/incetaricontracte', component: IncetariContracte, name: 'incetari-contracte'},
        {path: '/user/situatii/mutari', component: MutariPersonal, name: 'mutari-personal'},
        {path: '/user/situatii/salarii/lunare', component: SalariiLunare, name: 'salarii-lunare'},
        {path: '/user/situatii/salarii/trimestriale', component: SalariiTrimestriale, name: 'salarii-trimestriale'},
        {path: '/user/situatii/salarii/semestriale', component: SalariiSemestriale, name: 'salarii-semstriale'},
        {path: '/user/situatii/salarii/anuale', component: SalariiAnuale, name: 'salarii-anuale'},
        {path: '/user/situatii/cass/neachitat', component: CassNeachitat, name: 'cass-neachitat'},
        {path: '/user/situatii/cass/achitat', component: CassAchitat, name: 'cass-achitat'},


        // Rute pentru admin nomenclator
        {path: '/admin/nomenclator/regiuni', component: NomenclatorRegiuni, name: 'nomenclator-regiuni'},
        {path: '/admin/nomenclator/judete', component: NomenclatorJudete, name: 'nomenclator-judete'},
        {path: '/admin/nomenclator/localitati', component: NomenclatorLocalitati, name: 'nomenclator-localitati'},
        {path: '/admin/nomenclator/institutii', component: NomenclatorInstitutii, name: 'nomenclator-institutii'},



        {path: '/admin/utilizatori/access', component: AccesUtilizatori, name: 'utilizatori-acces'},


        // Rute pentru angajati
        {path: '/angajat/:id', component: Angajat, name: 'angajat'},
        {path: '/angajat/dateplata/:id', component: DatePlata, name: 'angajat-date-plata'},
        {path: '/angajat/adrese/:id', component: AdreseAngajat, name: 'angajat-adrese'},
    ]
});

export default router;
