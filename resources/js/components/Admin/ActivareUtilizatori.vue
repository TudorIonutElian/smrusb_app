<template>
    <div class="container-fluid">
        <top-nav
            :utilizatori-inactivi="utilizatoriInactivi.length"
            :este-administrator="isAdmin">
        </top-nav>
        <div class="container" v-if="isAdmin === true">
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr class="bg-success-head-row">
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nume</th>
                            <th scope="col">Email</th>
                            <th scope="col">Stare</th>
                            <th scope="col">Actiune</th>
                        </tr>
                        </thead>
                        <tbody class="angajati">
                         <tr v-if="utilizatoriInactivi.length > 0" v-for="utilizator in utilizatoriInactivi" :key="utilizatoriInactivi.id">
                            <th scope="row">{{ utilizator.id }}</th>
                             <td>{{ utilizator.user_username }}</td>
                            <td>{{ utilizator.user_name }}</td>
                            <td>{{ utilizator.user_email }}</td>
                            <td class="td-inactiv">Inactiv</td>
                            <td>
                                <button class="btn btn-success-activate btn-sm" @click="activeazaCont(utilizator.id)">Activeaza Cont
                                </button>
                            </td>
                        </tr>
                        <tr v-if="utilizatoriInactivi.length === 0">
                            <td colspan="8" class="bg-warning text-center">Nu exista utilizatori inactivi</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div v-else class="container">
            <no-acces></no-acces>
        </div>
        <div v-if="showAnimation === true">
            <alerta-admin mesajAlerta="Utlizator Activ"></alerta-admin>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import AlertaAdmin from "../Alerte/AlertaAdmin";
import NoAcces from './NoAcces';
export default {
    data(){
        return{
            utilizatoriInactivi: [],
            utilizator: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            showAnimation: false,
            isAdmin: (JSON.parse(localStorage.getItem('isAdmin')))
        }
    },
    created(){
        this.preluareUtilizatoriInactivi();
    },
    methods:{
        async preluareUtilizatoriInactivi(){
           await axios.get('/api/users/activare', {
               headers:{
                   ContentType: 'application/json',
                   Authorization : 'Bearer ' + this.token
               }
           }).then(response =>{
               this.utilizatoriInactivi = response.data;
           })
        },
        checkRoleName(role) {
            if (role === 1) {
                return 'Administrator'
            } else if (role === 2) {
                return 'Angajat'
            } else if (role === 3) {
                return 'Specialist Resurse Umane'
            } else if (role === null) {
                return 'Far rol'
            }
        },
        async activeazaCont(id){
            await axios.post('/api/users/activeaza', {
                contID : id
            },{
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                this.showAnimation = false;
                this.preluareUtilizatoriInactivi();
            }).then(()=>{
                this.showAnimation = true;
            });
        }
    },
    components:{
        NoAcces,
        AlertaAdmin,
        TopNav
    }
}
</script>

<style scoped>
.bg-success-head-row{
    color: #44bd32;
}
.td-inactiv{
    color: #eb4d4b;
    border-radius: 5px;
    font-weight: bold;
}
table{
    text-align: center;
}
tbody.angajati{
    text-align: center;
}
.btn-success-activate{
    background-color: #44bd32;
    color: #ffffff;
}
.btn-success-activate:hover{
    background-color: #ffffff;
    color: #44bd32;
    border: 1px solid #44bd32;
}
</style>
