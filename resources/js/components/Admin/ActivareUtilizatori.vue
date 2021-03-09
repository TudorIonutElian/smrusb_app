<template>
    <div class="container-fluid">
        <top-nav :utilizatori-inactivi="utilizatoriInactivi.length"></top-nav>
        <div class="container">
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr class="bg-success text-white">
                            <th scope="col">#</th>
                            <th scope="col">Nume</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tip</th>
                            <th scope="col">Stare</th>
                            <th scope="col">Actiune</th>
                        </tr>
                        </thead>
                        <tbody class="angajati">
                        <tr v-if="utilizatoriInactivi.length > 0" v-for="utilizator in utilizatoriInactivi" :key="utilizatoriInactivi.id">
                            <th scope="row">{{ utilizator.id }}</th>
                            <td>{{ utilizator.name }}</td>
                            <td>{{ utilizator.email }}</td>
                            <!-- Admin -->
                            <td v-if="utilizator.userType=== 1"><span
                                class="admin-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                            <!-- Specialist Resurse Umane -->
                            <td v-if="utilizator.userType=== 3"><span
                                class="specialist-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                            <!-- Angajat -->
                            <td v-if="utilizator.userType=== 2"><span
                                class="angajat-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                            <!-- Fara rol -->
                            <td v-if="utilizator.userType=== null"><span
                                class="faraRol-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                            <td>Inactiv</td>
                            <td>
                                <button class="btn btn-success btn-sm" @click="activeazaCont(utilizator.id)">Activeaza Cont
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
        <div v-if="showAnimation === true">
            <alerta-admin mesajAlerta="Activare Utilizator"></alerta-admin>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import AlertaAdmin from "../Alerte/AlertaAdmin";
export default {
    data(){
        return{
            utilizatoriInactivi: [],
            utilizator: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            showAnimation: false
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
        AlertaAdmin,
        TopNav
    }
}
</script>

<style scoped>

</style>
