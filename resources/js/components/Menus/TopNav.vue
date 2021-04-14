<template>
    <div id="topNavArea">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
            <div class="container">
                <a class="navbar-brand ml-auto" href="/">SMRUSB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Acasa</a>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 3">
                            <a class="nav-link dropdown-toggle" href="#" id="angajat_pontaj" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pontaj
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/user/angajat/pontaj/creare">Adaugare</a></li>
                                <li><a class="dropdown-item" href="/user/angajat/pontaj/modificare">Modificare</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 1">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Nomenclator
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/admin/nomenclator/regiuni">Regiuni</a></li>
                                <li><a class="dropdown-item" href="/admin/nomenclator/judete">Judete</a></li>
                                <li><a class="dropdown-item" href="/admin/nomenclator/localitati">Localitati</a></li>
                                <li><a class="dropdown-item" href="/admin/nomenclator/institutii">Institutii</a></li>
                                <li><a class="dropdown-item" href="/admin/nomenclator/angajati">Angajati</a></li>
                                <li><a class="dropdown-item" href="/admin/nomenclator/functii">Functii</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 1">
                            <a class="nav-link dropdown-toggle" href="#" id="stat" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Stat de Organizare
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/admin/stat/creare">Creeaza Stat</a></li>
                                <li><a class="dropdown-item" href="/admin/stat/modificare">Modifica Posturi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="optiuniUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Angajati
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/adauga_angajat">
                                        <img class="mr-2" src="/images/useradd.png" alt="">
                                        <span>Adauga angajat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/numire_angajat">
                                        <img class="mr-2" src="/images/numireangajat.png" alt="">
                                        <span>Numire angajat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/mutare_angajat">
                                        <img class="mr-2" src="/images/usermove.png" alt="">
                                        <span>Mutare angajat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/incetare_angajat">
                                        <img class="mr-2" src="/images/usermove.png" alt="">
                                        <span style="color: red">Incetare raport</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/">
                                        <img class="mr-2" src="/images/majoraresalariu.png" alt="">
                                        <span style="color: red">Majorare Salariu</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/">
                                        <img class="mr-2" src="/images/scaderesalariu.png" alt="">
                                        <span style="color: red">Scadere Salariu</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="optiuniEvaluare" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Evaluare profesionala
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/adauga_angajat">
                                        <img class="mr-2" src="/images/evaluare.png" alt="">
                                        <span style="color: red">Vizualizare</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/adauga_angajat">
                                        <img class="mr-2" src="/images/evaluare_adaugare.png" alt="">
                                        <span style="color: red">Adaugare</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/adauga_angajat">
                                        <img class="mr-2" src="/images/evaluare_cautare.png" alt="">
                                        <span style="color: red">Recompense</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/adauga_angajat">
                                        <img class="mr-2" src="/images/evaluare_cautare.png" alt="">
                                        <span style="color: red">Sanctiuni</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="optiuniStat" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Stat Organizare
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/stat/vizualizare">
                                        <img class="mr-2" src="/images/vizualizare_stat.png" alt="">
                                        <span>Stat Vizualizare</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/stat/suplimentare">
                                        <img class="mr-2" src="/images/suplimentare_stat.png" alt="">
                                        <span>Stat Suplimentare</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/stat/radiere">
                                        <img class="mr-2" src="/images/radiere_stat.png" alt="">
                                        <span>Stat Radiere</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/stat/vacante">
                                        <img class="mr-2" src="/images/vacante_stat.png" alt="">
                                        <span>Stat Vacante</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/stat/cuprins">
                                        <img class="mr-2" src="/images/cuprins_stat.png" alt="">
                                        <span>Stat Cuprins</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="user_pontaj" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Salarii
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/user/salarii/generare">Generare Salarii</a></li>
                                <li><a class="dropdown-item" href="/user/salarii/vizualizare">Vizualizare Salarii</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="situatiiProfesionale" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Situatii
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#" style="color: red">Incetari contracte de munca</a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Situatie mutari de personal</a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Situatie detasari de personal</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Situatii salarii lunare</a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Situatii salarii trimestriale</a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Situatii salarii semestriale</a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Situatii salarii anuale</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Plati CASS</a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Plati Impozit venit</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="pontaj" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pontaj
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/user/pontaj/vizualizare">Pontaj-Vizualizare </a></li>
                                <li><a class="dropdown-item" href="#">Pontaj-Aprobare </a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Pontaj-Salvare PDF </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="documente" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Documente
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#" style="color: red">Adeverinta angajat </a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Adeverinta asigurat </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Adeverinta dosar pensie</a></li>
                                <li><a class="dropdown-item" href="#" style="color: red">Adeverinta salarii</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div v-if="user">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Welcome {{ this.user.user_first_name.concat(' ').concat(this.user.user_last_name)}}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" :href="'/user/profile/' + user.id">
                                                <img src="/images/pannel.png" alt="">
                                                Panou de control
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li v-if="this.esteAdministrator">
                                            <a class="dropdown-item" href="/utilizatori/activare">
                                                <img src="/images/accounts.png" alt="">
                                                Solicitari Activare Conturi
                                                <span> ({{ this.utilizatoriInactivi ? this.utilizatoriInactivi : 0}})</span>
                                            </a>
                                        </li>
                                        <li v-if="this.esteAdministrator">
                                            <a class="dropdown-item" href="/admin/utilizatori/access">
                                                <img src="/images/accounts.png" alt="">
                                                Solicitari Acces Institutii
                                                <span> (0) </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" :href="'/user/changepassword/' + user.id">
                                                <img src="/images/password.png" alt="">
                                                Schimbare parola
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" :href="'/user/solicitare_acces/' + user.id">
                                                <img src="/images/acces_solicitare.png" alt="">
                                                Solicitare Acces
                                            </a>
                                        </li>
                                        <li v-if="this.user.isAdmin === 1"><a class="dropdown-item" href="#">Admin Dashboard</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <a v-if="isLoggedIn === false" href="/login" class="btn btn-outline-success">Login</a>
                        <a v-if="isLoggedIn === false" href="/inregistrare" class="btn btn-outline-danger ml-1">Inregistrare</a>
                        <a v-if="isLoggedIn" class="btn btn-outline-danger ml-1" @click.prevent="logout">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import router from "../../router/router";
import {checkIfIsAdmin, checkIfLoggedIn} from "../../functions/auth/authFunctions";
export default {
    data: function () {
        return {
            isLoggedIn: checkIfLoggedIn(),
            isAdmin: checkIfIsAdmin(),
            user: JSON.parse(localStorage.getItem('user')),
            searchComponent: 'angajati'
        }
    },
    created() {
        this.checkLoggedIn();
    },
    methods:{
        checkLoggedIn(){
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            if(isLoggedIn === 'true'){
                this.user = JSON.parse(localStorage.getItem('user'));
            }
        },
        async logout(){
            const token = localStorage.getItem('token');
            await axios.post('/logout',{}, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + token
                }
            });
            this.$store.dispatch('setAdminLoggedOut', false);
            router.push('/login');
        }
    },
    props: ['utilizatori-inactivi', 'este-administrator']
}
</script>

<style scoped>
#topNavArea{
    width: 100%;
    height: 5vh;
}
.dropdown-item{
    margin-right: 10px;
}
</style>
