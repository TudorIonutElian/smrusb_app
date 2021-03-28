<template>
    <div class="container-fluid">
        <top-nav
            :este-administrator="isAdmin"
            :utilizatori-inactivi="utilizatoriInactivi"
        ></top-nav>
        <div v-if="isAdmin === true || isAdmin === 'true'" class="container pt-4">
            <div class="row">
                <div class="col-12">
                    <div class="input-group flex-nowrap">
                        <span id="addon-wrapping" class="input-group-text mr-2">Introduceti numele judetului</span>
                        <input v-model="judet_nou.denumire" class="form-control mr-2" placeholder="Introducet numele regiunii"
                               type="text">
                        <button class="btn btn-success">Adauga Regiunea</button>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table text-center">
                        <thead>
                        <tr class="bg-success-head-row">
                            <th scope="col">#</th>
                            <th class="text-right" scope="col">Regiune</th>
                            <th scope="col">Data Creare</th>
                            <th scope="col">Stare</th>
                            <th scope="col">Numar Judete</th>
                            <th scope="col">Actiune</th>
                            <th scope="col">Vezi Istoric</th>
                        </tr>
                        </thead>
                        <tbody class="angajati">
                        <tr v-for="regiuni in regiuni" :key="regiuni.id">
                            <th scope="row">{{ regiuni.regiune_id }}</th>
                            <td class="text-right">{{ regiuni.regiune_denumire }}</td>
                            <td>{{ regiuni.regiune_data_creare }}</td>
                            <td v-if="regiuni.regiune_stare === 1" class="regiune_activa">Activa</td>
                            <td v-if="regiuni.regiune_stare === 0" class="regiune_inactiva">Inactiva</td>
                            <td class="regiune_numar_judete">{{ regiuni.regiune_numar_judete }}</td>
                            <td v-if="regiuni.regiune_stare === 0">
                                <button class="btn btn-outline-success btn-sm" @click="activeazaRegiune(regiuni.regiune_id)">Activeaza Regiune</button>
                            </td>
                            <td v-if="regiuni.regiune_stare === 1">
                                <button class="btn btn-outline-danger btn-sm" @click="suspendaRegiune(regiuni.regiune_id)">Suspenda Regiune</button>
                            </td>
                            <td><a :href="'/admin/nomenclator/regiuni/' + regiuni.regiune_id + '/istoric'"
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
            await axios.get('/api/admin/nomenclator/judete', {
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
                this.preluareRegiuni();
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
                console.log(response)
                this.preluareJudete();
            })
        },


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

</style>
