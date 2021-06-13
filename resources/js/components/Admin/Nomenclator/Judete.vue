<template>
    <div class="container-fluid">
        <top-nav
            :este-administrator="isAdmin"
            :utilizatori-inactivi="utilizatoriInactivi"
        ></top-nav>
        <div v-if="isAdmin === true || isAdmin === 'true'" class="container pt-4">
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table text-center">
                        <thead>
                        <tr class="bg-success-head-row">
                            <th scope="col">#</th>
                            <th class="text-right" scope="col">Judet</th>
                            <th scope="col">Data Creare</th>
                            <th scope="col">Stare</th>
                            <th scope="col">Numar Localitati</th>
                            <th scope="col">Actiune</th>
                            <th scope="col">Vezi Istoric</th>
                        </tr>
                        </thead>
                        <tbody class="angajati">
                        <tr v-for="judet in judete" :key="judet.judet_id">
                            <th scope="row">{{ judet.judet_id }}</th>
                            <td>{{ judet.judet_denumire }}</td>
                            <td>{{ judet.judet_data_creare }}</td>
                            <td v-if="judet.judet_stare === 1" class="judet_activ">Activ</td>
                            <td v-if="judet.judet_stare === 0" class="judet_inactiv">Inactiv</td>
                            <td class="regiune_numar_judete">{{ judet.judet_numar_localitati }}</td>
                            <td v-if="judet.judet_stare === 0">
                                <button class="btn btn-outline-success btn-sm" @click="activeazaJudet(judet.judet_id)">Activeaza Judet</button>
                            </td>
                            <td v-if="judet.judet_stare === 1">
                                <button class="btn btn-outline-danger btn-sm" @click="suspendaJudet(judet.judet_id)">Suspenda Judet</button>
                            </td>
                            <td><a :href="'/admin/nomenclator/judet/' + judet.judet_id + '/istoric'"
                                   class="btn btn-outline-primary btn-sm btn-block">Istoric</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div v-else class="container">
            <no-acces></no-acces>
        </div>
    </div>
</template>

<script>
import TopNav from '../../Menus/TopNav';
import NoAcces from '../NoAcces';

export default {
    data() {
        return {
            isAdmin: localStorage.getItem('isAdmin'),
            utilizatoriInactivi: [],
            token: localStorage.getItem('token'),
            judete: [],
            judet_nou: {
                denumire: ""
            }
        }
    },
    created() {
        this.preluareUtilizatoriInactivi();
        this.preluareJudete();
    },
    methods: {
        async preluareUtilizatoriInactivi() {
            await axios.get('/api/users/activare', {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                this.utilizatoriInactivi = response.data.length;
            })
        },
        async preluareJudete() {
            await axios.get('/api/admin/nomenclator/judet', {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                this.judete = response.data.data
            })
        },
        async suspendaJudet(id) {
            await axios.post('/api/admin/nomenclator/judet/suspenda', {
                judet_id: id
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                Vue.$toast.open({
                    message: 'Judetul a fost suspendat',
                    type: 'error',
                    // all of other options may go here
                });
                this.preluareJudete();
            })
        },
        async activeazaJudet(id) {
            await axios.post('/api/admin/nomenclator/judet/activeaza', {
                judet_id: id
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                Vue.$toast.open({
                    message: 'Judetul a fost activat',
                    type: 'success',
                    // all of other options may go here
                });
                this.preluareJudete();
            })
        },
        filtrareJudet(event){
            const valoareStringNume = event.target.value;
            const judeteFiltrate = [];
            this.judete.forEach(judet=>{
                let judetLower = judet.judet_denumire.toLowerCase();
                if(judetLower.includes(valoareStringNume.toLowerCase())){
                    salariiFiltrate.push(salariu)
                }
            })
        }


    },
    components: {
        TopNav,
        NoAcces
    }
}
</script>

<style scoped>
tr:hover{
    background-color: #c8d6e5;
}
tr:hover > td button.btn-outline-danger{
    background-color: #ee5253;
    color: #ffffff;
}
tr:hover > td button.btn-outline-success{
    background-color: #1dd1a1;
    color: #ffffff;
}

.judet_activ{
    color: #1dd1a1;
    font-weight: bolder;
}

.judet_inactiv{
    color: #ee5253;
    font-weight: bolder;
}

</style>
