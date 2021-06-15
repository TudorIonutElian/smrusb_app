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
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                aria-current="page" href="/despre"
                                v-if="user === null"
                            >Despre</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                aria-current="page" href="/"
                                v-if="user === null"
                            >Module</a>
                        </li>
                        <li class="nav-item" v-if="user != null && user.user_type === 3">
                            <router-link class="nav-link active" :to="{ name: 'angajat-date-plata', params: { id: this.user.id}}">Date plata</router-link>
                        </li>
                        <li class="nav-item" v-if="user != null && user.user_type === 3">
                            <router-link class="nav-link active" :to="{ name: 'angajat-adrese', params: { id: this.user.user_angajat_id}}">Adrese</router-link>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 3">
                            <a class="nav-link dropdown-toggle" href="#" id="angajat_salarii" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Salarii
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/">Vizualizare</a></li>
                                <li><a class="dropdown-item" href="/">Export</a></li>
                            </ul>
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
                                    <a class="dropdown-item dropdown-item-flex" href="/user/angajat/incetare_angajat">
                                        <img class="mr-2" src="/images/incetarecontract.png" alt="">
                                        <span>Incetare raport</span>
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
                                    <a class="dropdown-item dropdown-item-flex" href="/user/evaluare/vizualizare">
                                        <img class="mr-2" src="/images/evaluare_adaugare.png" alt="">
                                        <span>Vizualizare</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/evaluare/adaugare">
                                        <img class="mr-2" src="/images/evaluare_adaugare.png" alt="">
                                        <span>Adaugare</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/evaluare/aprobare">
                                        <img class="mr-2" src="/images/evaluare_adaugare.png" alt="">
                                        <span>Aprobare</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/evaluare/contestatii">
                                        <img class="mr-2" src="/images/contestatie.png" alt="">
                                        <span>Contestatii</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/recompense/adaugare">
                                        <img class="mr-2" src="/images/evaluare_cautare.png" alt="">
                                        <span>Recompense</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/sanctiuni/adaugare">
                                        <img class="mr-2" src="/images/evaluare_cautare.png" alt="">
                                        <span>Sanctiuni</span>
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
                                <li>
                                    <a class="dropdown-item" href="/user/situatii/incetaricontracte">
                                        Incetari contracte de munca
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="/user/situatii/mutari">Situatie mutari de personal</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/user/situatii/salarii/lunare">Situatii salarii lunare</a></li>
                                <li><a class="dropdown-item" href="/user/situatii/salarii/trimestriale">Situatii salarii trimestriale</a></li>
                                <li><a class="dropdown-item" href="/user/situatii/salarii/semestriale">Situatii salarii semestriale</a></li>
                                <li><a class="dropdown-item" href="/user/situatii/salarii/anuale">Situatii salarii anuale</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/user/situatii/cass/neachitat">CASS Neachitat</a></li>
                                <li><a class="dropdown-item" href="/user/situatii/cass/achitat">CASS Achitat</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="pontaj" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pontaj
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/user/pontaj/vizualizare">Pontaj-Vizualizare </a></li>
                                <li><a class="dropdown-item" href="/user/pontaj/aprobare">Pontaj-Aprobare </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="documente" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Documente
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/user/adeverinte/adeverintaangajat">Adeverinta angajat </a></li>
                                <li><a class="dropdown-item" href="/user/adeverinte/adeverintaasigurat">Adeverinta asigurat </a></li>
                                <li><a class="dropdown-item" href="/user/adeverinte/adeverintasalarii">Adeverinta salarii</a></li>
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
                                            <a class="dropdown-item text-center" href="">
                                                <span v-if="user != null && user.user_type === 1" class="btn btn-block btn-sm user_admin">Administrator</span>
                                                <span v-if="user != null && user.user_type === 0" class="btn btn-block btn-sm user_operator">Operator</span>
                                                <span v-if="user != null && user.user_type === 3" class="btn btn-block btn-sm user_angajat">Angajat</span>
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
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
                                        <li v-if="user != null && user.user_type === 0">
                                            <a class="dropdown-item" :href="'/user/angajati/aprobare/' + user.id">
                                                <img src="/images/account.png" alt="">
                                                Aprobare Angajat
                                            </a>
                                        </li>
                                        <li v-if="user != null && user.user_type === 0">
                                            <a class="dropdown-item" href="/user/pontaj/aprobare">
                                                <img src="/images/pontaj.png" alt="">
                                                Aprobare Pontaj
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
            router.push({ name: 'login', query:{status: 'deconectat'}} )
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
.user_operator,
.user_angajat,
.user_admin{
    color: #fff;
    border-radius: 3px;
    padding: 10px;
    font-weight: bolder;
}

.user_admin{
    background-color: #e55039;
}

.user_operator{
    background-color: #4a69bd;
}
.user_angajat{
    background-color: #60a3bc;
}
</style>
