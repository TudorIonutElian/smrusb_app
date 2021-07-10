<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
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
                            <tr v-for="(angajat, index) in lista_angajati" class="tr-angajat">
                                <th scope="row">{{ index+1}}</th>
                                <td>{{ angajat.angajat_nume }}</td>
                                <td>{{ angajat.angajat_prenume }}</td>
                                <td>{{ angajat.angajat_cnp }}</td>
                                <td>{{ angajat.angajat_institutie}}</td>
                                <td>
                                    <span v-if="angajat.angajat_status == 1">{{ angajat.angajat_functie ? angajat.angajat_functie: 'Nu este numit.' }}</span>
                                    <span v-if="angajat.angajat_status == 0" class="contract-incetat">Contract incetat</span>
                                </td>
                                <td><a
                                    :href="'/user/mutare_angajat/' + angajat.angajat_id"
                                    class="btn btn-sm btn-secondary btn-show"
                                    :class="angajat.angajat_status == 0 ? 'btn-disabled disabled' : ''"
                                >Muta Angajat</a></td>
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
.tr-angajat:hover{
    font-weight: bolder;
    color: #38c172;
    background-color: #fff;
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
