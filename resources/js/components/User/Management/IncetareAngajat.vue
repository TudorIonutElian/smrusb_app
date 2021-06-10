<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 d-flex mb-2">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="Introduceti numele angajatului ..."
                            aria-label="Search"
                            v-model="filtrare.searchName"
                            @keyup="getAngajatiByName"
                        >
                        <button
                            class="btn btn-outline-danger ml-1"
                            type="submit"
                            @click.prevent="resetFilters"
                        >Reseteaza</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr class="bg-success text-white">
                                <th scope="col">#</th>
                                <th scope="col">Nume</th>
                                <th scope="col">Prenume</th>
                                <th scope="col">CNP</th>
                                <th scope="col">Institutia</th>
                                <th scope="col">Functia</th>
                                <th scope="col">Mutare</th>
                            </tr>
                            </thead>
                            <tbody class="angajati">
                            <tr v-for="(angajat, index) in lista_angajati" class="tr-angajat" v-if="angajat.angajat_status != 0">
                                <th scope="row">{{ index+1}}</th>
                                <td>{{ angajat.angajat_nume }}</td>
                                <td>{{ angajat.angajat_prenume }}</td>
                                <td>{{ angajat.angajat_cnp }}</td>
                                <td>{{ angajat.angajat_institutie}}</td>
                                <td>{{ angajat.angajat_functie }}</td>
                                <td><a :href="'/user/angajat/incetare_angajat/' + angajat.angajat_id" class="btn btn-sm btn-outline-danger btn-show">Incetare Contract</a></td>
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
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            lista_angajati: [],
            user_id: JSON.parse(localStorage.getItem('user')).id,
            lista_acces: [],
            filtrare: {
                searchName: ""
            }
        }
    },
    components:{
        TopNav
    },
    created(){
        this.preluareAngajati();
    },
    methods:{
        async preluareAngajati(){
            axios.get(`/api/angajati/${this.user_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.lista_angajati = response.data.data
            })
        },
        async getAngajatiByName(){
            const valoareStringNume = this.filtrare.searchName;
            if(valoareStringNume === ""){
                await this.preluareAngajati()();
            }else{
                const angajatiFiltrat = [];
                this.lista_angajati.forEach(angajat=>{
                    let angajatNume     = angajat.angajat_nume.toLowerCase();
                    let angajatPrenume  = angajat.angajat_prenume.toLowerCase();
                    if(angajatNume.includes(valoareStringNume.toLowerCase()) || angajatPrenume.includes(valoareStringNume.toLowerCase())){
                        angajatiFiltrat.push(angajat)
                    }
                })

                this.lista_angajati = angajatiFiltrat;
            }
        },
        async resetFilters(){
            this.filtrare.searchName = "";
            await this.preluareAngajati();
        }
    }
}
</script>

<style scoped>
.btn-outline-danger btn-show:hover{
    color: #ffffff;
    background-color:#e74c3c;
    border: 2px #e74c3c;
}
.tr-angajat:hover{
    font-weight: bolder;
    color: #38c172;
    background-color: #fff;
}
</style>
