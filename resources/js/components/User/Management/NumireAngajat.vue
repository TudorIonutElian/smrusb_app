<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 d-flex mb-2">
                        <input class="form-control me-2" type="search" placeholder="Introduceti numele angajatului ..." aria-label="Search">
                        <button class="btn btn-outline-success ml-1" type="submit">Cauta</button>
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
                                <th scope="col">Gradul</th>
                                <th scope="col">CNP</th>
                                <th scope="col">Institutia</th>
                                <th scope="col">Functia</th>
                                <th scope="col">Fisa Evidenta</th>
                            </tr>
                            </thead>
                            <tbody class="angajati">
                            <tr v-for="(angajat, index) in lista_angajati">
                                <th scope="row">{{ index+1}}</th>
                                <td>{{ angajat.angajat_nume }}</td>
                                <td>{{ angajat.angajat_prenume }}</td>
                                <td>-</td>
                                <td>{{ angajat.angajat_cnp }}</td>
                                <td>{{ angajat.angajat_institutie }}</td>
                                <td>
                                    <span v-if="angajat.angajat_status == 1">{{ angajat.angajat_functie ? angajat.angajat_functie: 'Nu este numit.' }}</span>
                                    <span v-if="angajat.angajat_status == 0" class="contract-incetat">Contract incetat</span>
                                </td>
                                <td><a
                                    :href="'/user/numire_angajat/' + angajat.angajat_id"
                                    class="btn btn-sm btn-secondary btn-show"
                                    :class="angajat.angajat_status == 0 ? 'btn-disabled disabled' : ''"
                                >Numire Angajat</a></td>
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
            lista_acces: []
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
                console.log(response)
                this.lista_angajati = response.data.data
            })
        }
    }
}
</script>

<style scoped>
.btn-show{
    border: none;
}
.btn-show:hover{
    color: #ffffff;
    background-color: #38c172;
    border: none;
}
.btn-disabled{
    background-color: #e74c3c;
    border: none;
    outline: none;
}
.contract-incetat{
    color: #e74c3c;
    font-weight: bold;
}
</style>
