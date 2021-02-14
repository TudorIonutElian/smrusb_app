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
                        <li class="nav-item dropdown" v-if="user != null && user.isAdmin === 1">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Nomenclator
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/regiuni">Regiuni</a></li>
                                <li><a class="dropdown-item" href="/judete">Judete</a></li>
                                <li><a class="dropdown-item" href="/localitati">Localitati</a></li>
                                <li><a class="dropdown-item" href="/ordonatori">Ordonatori</a></li>
                                <li><a class="dropdown-item" href="/institutii">Institutii</a></li>
                                <li><a class="dropdown-item" href="/angajati">Angajati</a></li>
                                <li><a class="dropdown-item" href="/functii">Functii</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div v-if="user">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Welcome {{ this.user.name}}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">{{ user.email }}</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Notificari <span>(0)</span></a></li>
                                        <li><a class="dropdown-item" :href="'/api/user/profile/' + user.id">Panou de control</a></li>
                                        <li><a class="dropdown-item" :href="'/api/user/changepassword/' + user.id">Schimbare parola</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li v-if="this.user.isAdmin === 1"><a class="dropdown-item" href="#">Admin Dashboard</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <a v-if="isLoggedIn === false" href="/login" class="btn btn-outline-success">Login</a>
                        <a v-if="isLoggedIn === false" class="btn btn-outline-danger ml-1" @click.prevent="logout">Inregistrare</a>
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
                user: null
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
        }
    }
</script>

<style scoped>
#topNavArea{
    width: 100vw;
    height: 5vh;
}
.dropdown-item span{
    font-weight: bold;
    color: #1abc9c;
}
</style>
