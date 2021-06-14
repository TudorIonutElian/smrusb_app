<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container-fluid mt-4 container-angajati">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Pozitie</th>
                                <th scope="col">Functie</th>
                                <th scope="col">Suma</th>
                                <th scope="col">De la</th>
                                <th scope="col">Pana la</th>
                                <th scope="col">Achitat</th>
                                <th scope="col">Data Achitare</th>
                                <th scope="col">Taxa CASS</th>
                                <th scope="col">Valoare CASS</th>
                                <th scope="col">Cass Platit</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(s, index) in lista_salarii"
                                >
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ s.salariu_institutie }}</td>
                                    <td>{{ s.salariu_pozitie }}</td>
                                    <td>{{ s.salariu_functie }}</td>
                                    <td>{{ s.salariu_suma }}</td>
                                    <td>{{ s.salariu_dela }}</td>
                                    <td>{{ s.salariu_panala }}</td>
                                    <td>
                                        <span v-if="s.salariu_achitat == 0" class="neachitat">Nu</span>
                                        <span v-if="s.salariu_achitat == 1" class="achitat">Da</span>
                                    </td>
                                    <td>{{ s.salariu_datachitare }}</td>
                                    <td>{{ s.salariu_taxacass }}</td>
                                    <td>{{ s.salariu_valoarecass }} lei</td>
                                    <td>
                                        <span v-if="s.salariu_achitarecass == 0" class="neachitat">Nu</span>
                                        <span v-if="s.salariu_achitarecass == 1" class="achitat">Da</span>
                                    </td>
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
            loading: false,
            user: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            lista_salarii: []
        }
    },
    created(){
        this.preluareSalarii();
    },
    components:{
        TopNav,
    },
    methods:{
        async preluareSalarii(){
            this.loading = true;
            await axios.get(`/api/user/angajati/salarii/${this.user.user_angajat_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then( response => {
                this.lista_salarii = response.data.data;
                this.loading = false;
            })
        },
    }
}
</script>

<style scoped>

.achitat{
    font-weight: bolder;
    color: #00b894;
}

.neachitat{
    font-weight: bolder;
    color: #d63031;
}
</style>
