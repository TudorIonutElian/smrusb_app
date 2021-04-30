<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 my-3">
                        <span class="badge">
                            Aprobare Conturi Angajati
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex mb-2">
                        <input class="form-control me-2" type="search" placeholder="Introduceti numele angajatului ..." aria-label="Search">
                        <button class="btn btn-badge ml-1" type="submit">Cauta</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Utilizator</th>
                                <th scope="col">Nume</th>
                                <th scope="col">Prenume</th>
                                <th scope="col">Aprobare</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-if="utilizatori_inactivi !== null || utilizatori_inactivi.length != 0"
                                    v-for="(u, index) in utilizatori_inactivi" :key="u.id"
                                >
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{u.user_username}}</td>
                                    <td>{{u.user_nume}}</td>
                                    <td>{{u.user_prenume}}</td>
                                    <td>
                                        <button
                                            class="btn btn-success btn-sm"
                                            @click.prevent="aprobareCont(u.id)"
                                        >Aprobare Cont</button>
                                    </td>
                                </tr>
                                <tr
                                    v-if="utilizatori_inactivi.length === 0"
                                >
                                    <td colspan="5"
                                    class="bg-warning text-center">Nu exista conturi inactive.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";

export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            user_id: JSON.parse(localStorage.getItem('user')).id,
            utilizatori_inactivi: null
        }
    },
    components:{
        TopNav
    },
    created(){
        this.preluareUseriInactivi();
    },
    methods:{
        async preluareUseriInactivi(){
            axios.get(`/api/users/angajati/aprobare/${this.user_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.utilizatori_inactivi = response.data.data;
            })
        },
        async aprobareCont(angajat_id){
            await axios.post(`/api/users/angajataccount/${angajat_id}/aprobare`, {}, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                if(response.data.cod_raspuns === 2000){
                    this.preluareUseriInactivi();
                    Vue.$toast.open({
                        message: 'Contul a fost aprobat',
                        type: 'success',
                        // all of other options may go here
                    });
                }
            })
        }
    }
}
</script>

<style scoped>
span.badge{
    padding: 10px;
    background-color: #3498db;
    font-size: 14px;
    color: #fff;
}
.btn-badge{
    background-color: #3498db;
    font-size: 16px;
    color: #fff;
}
.btn-badge:hover{
    background-color: #636e72;
}
</style>
