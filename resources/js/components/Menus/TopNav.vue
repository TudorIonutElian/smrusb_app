<template>
    <div id="topNavArea">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                            <a class="nav-link" href="/despre">Despre</a>
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
                        <li class="nav-item dropdown" v-if="user != null && user.user_type === 0">
                            <a class="nav-link dropdown-toggle" href="#" id="optiuniUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Management Resurse
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/user/adauga_angajat">
                                        <img class="mr-2" src="/images/useradd.png" alt="">
                                        <span>Adauga angajat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/">
                                        <img class="mr-2" src="/images/numireangajat.png" alt="">
                                        <span>Numire angajat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/">
                                        <img class="mr-2" src="/images/usermove.png" alt="">
                                        <span>Mutare angajat</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/">
                                        <img class="mr-2" src="/images/majoraresalariu.png" alt="">
                                        <span>Majorare Salariu</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item dropdown-item-flex" href="/">
                                        <img class="mr-2" src="/images/scaderesalariu.png" alt="">
                                        <span>Scadere Salariu</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-if="user != null && user.user_type !== 1">
                            <a class="nav-link dropdown-toggle" href="#" id="navbaruserSearch" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cauta
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#" @click.prevent="setSearch('localitati')">Localitati</a></li>
                                <li><a class="dropdown-item" href="#" @click.prevent="setSearch('institutii')">Institutii</a></li>
                                <li><a class="dropdown-item" href="#" @click.prevent="setSearch('angajati')">Angajati</a></li>
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
                                        <li>
                                            <a class="dropdown-item" :href="'/user/changepassword/' + user.id">
                                                <img src="/images/password.png" alt="">
                                                Schimbare parola
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
</style>
