<template>
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
                    <th scope="col">Fisa Evidenta</th>
                </tr>
                </thead>
                <tbody class="angajati">
                <tr v-for="(angajat, index) in lista_angajati">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ angajat.angajat_nume }}</td>
                    <td>{{ angajat.angajat_prenume }}</td>
                    <td>{{ angajat.angajat_cnp }}</td>
                    <td>{{ angajat.angajat_institutie }}</td>
                    <td>
                        <span v-if="angajat.angajat_status != 0">{{
                                angajat.angajat_functie ? angajat.angajat_functie : 'Nu este numit.'
                            }}</span>
                        <span v-if="angajat.angajat_status == 0" class="contract_incetat">Contract incetat</span>
                    </td>
                    <td><a :href="'/angajat/' + angajat.angajat_id" class="btn btn-sm btn-secondary btn-show">Vezi
                        Angajat</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";

export default {
    props: ['optiuneFiltrare'],
    data(){
        return{
            token: localStorage.getItem('token'),
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            lista_angajati: [],
            user_id: JSON.parse(localStorage.getItem('user')).id,
            lista_acces: [],
            user: JSON.parse(localStorage.getItem('user')),
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
                this.lista_angajati = response.data.data;
                this.getAngajatiByName();
            })
        },
        async getAngajatiByName(){
            const valoareStringNume = this.optiuneFiltrare;
            if(valoareStringNume === "" || valoareStringNume === "reseted"){
                await this.preluareAngajati();
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
.btn-show{
    border: none;
}
.btn-show:hover{
    color: #ffffff;
    background-color: #38c172;
    border: none;
}
.contract_incetat{
    font-weight: bolder;
    color: #e74c3c;
}
</style>
