<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="!loading">
            <div class="container-fluid mt-4 container-angajati">
                <div class="row">
                    <div
                        class="col-12 bg-suplimentare-stat p-2 text-white text-center">
                        Vizualizare Salarii
                    </div>
                    <div class="col-12 my-3">
                        <div class="input-group flex-nowrap">
                            <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                            <select
                                class="form-control form-select mr-1"
                                id="angajat_judet_domiciliu"
                                v-model="generare_institutie_id"
                            >
                                <option v-for="aui in acces_user_institutii" :value="aui.id">{{ aui.institutie_denumire}}</option>
                            </select>
                        </div>
                    </div>
                    <div
                        class="col-12 my-3 p-2 bg-danger text-center text-white"
                        v-if="generare_erori.institutie_neselectata === true"
                    >
                        Nu ati selectat institutia, va rugam sa selectati!
                    </div>
                    <div class="col-4">
                        <a
                            href="/"
                            class="btn btn-primary btn-sm"
                            @click.prevent="vizualizareSalarii"
                        >Vizualizare Salarii</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institutie</th>
                                <!-- Pozitie -->
                                <th scope="col"
                                    @click.prevent="setFilterable('pozitie')"
                                    v-if="!filterable.pozitie">Pozitie</th>
                                <th scope="col"
                                    v-if="filterable.pozitie">
                                    <input type="text" @blur="resetFilterable('pozitie')" placeholder="Introduceti pozitia">
                                </th>
                                <!-- Functie -->
                                <th scope="col"
                                    @click.prevent="setFilterable('functie')"
                                    v-if="!filterable.functie">Functie</th>
                                <th scope="col"
                                    v-if="filterable.functie">
                                    <input type="text" @blur="resetFilterable('functie')" placeholder="Introduceti functia">
                                </th>

                                <!-- Angajat -->
                                <th scope="col"
                                    @click.prevent="setFilterable('angajat')"
                                    v-show="filterable.angajat === false">Angajat</th>
                                <th scope="col"
                                    v-if="filterable.angajat === true">
                                    <input type="text" @blur="resetFilterable('angajat')" placeholder="Introduceti numele">
                                </th>

                                <!-- De la  -->
                                <th scope="col"
                                    @click.prevent="setFilterable('dela')"
                                    v-show="filterable.dela === false">De la: </th>
                                <th scope="col"
                                    v-if="filterable.dela === true">
                                    <input type="text" @blur="resetFilterable('dela')" placeholder="De la">
                                </th>

                                <!-- Pana la -->
                                <th scope="col"
                                    @click.prevent="setFilterable('panala')"
                                    v-show="filterable.panala === false">Pana la: </th>
                                <th scope="col"
                                    v-if="filterable.panala === true">
                                    <input type="text" @blur="resetFilterable('panala')" placeholder="Pana la:">
                                </th>

                                <!-- Suma initiala -->
                                <th scope="col"
                                    @click.prevent="setFilterable('sumainitiala')"
                                    v-show="filterable.sumainitiala === false">Suma inititala: </th>
                                <th scope="col"
                                    v-if="filterable.sumainitiala === true">
                                    <input type="text" @blur="resetFilterable('sumainitiala')" placeholder="Introduceti suma">
                                </th>

                                <!-- Suma Finala -->
                                <th scope="col">Bonus</th>

                                <!-- Bonus -->
                                <th scope="col">Suma Finala</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tip Achitare</th>
                                <th scope="col">Moneda</th>
                            </tr>
                            </thead>
                            <tbody @click.prevent="resetAllFilters">
                                <tr
                                    v-for="(salariu, index) in salarii"
                                    v-bind:class="salariu.salariu_achitat == 0 ? 'salariu_neachitat' : 'salariu_achitat'"
                                >
                                    <th scope="row">{{ index + 1}}</th>
                                    <td>{{ salariu.salariu_institutie }}</td>
                                    <td>-</td>
                                    <td>{{ salariu.salariu_functie }}</td>
                                    <td>{{ salariu.salariu_angajat }}</td>
                                    <td>{{ salariu.salariu_start_date }}</td>
                                    <td>{{ salariu.salariu_end_date }}</td>
                                    <td>{{ salariu.salariu_suma_initiala }}</td>
                                    <td>{{ salariu.salariu_bonus }}</td>
                                    <td>{{ salariu.salariu_suma_finala }}</td>
                                    <td>{{ verificareAchitareSalariu(salariu.salariu_achitat) }}</td>
                                    <td>{{ verificareTipAchitare(salariu.salariu_tip_achitare) }}</td>
                                    <td>{{ salariu.salariu_moneda}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <loading-component v-if="loading"></loading-component>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
import LoadingComponent from "../../HelperComponents/LoadingComponent";
import router from "../../../router/router";

export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            user_id: JSON.parse(localStorage.getItem('user')).id,
            loading: false,
            acces_user_institutii: [],
            generare_institutie_id: 0,
            generare_erori:{
                institutie_neselectata: false
            },
            salarii: [],
            filterable:{
                pozitie: false,
                functie: false,
                angajat: false,
                dela: false,
                panala: false,
                sumainitiala: false,
                bonus: false,
                sumafinala: false,
                status: false,
                tipachitare: false
            }
        }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    created(){
        this.preluareUserAcces();
    },
    methods:{
        setFilterable(filter){
            console.log(filter)
            this.filterable[filter] = true;
        },
        resetFilterable(filter){
            this.filterable[filter] = false;
        },
        resetAllFilters(){
            for (var key in this.filterable ) {
                this.filterable[key] = false;
            }
        },
        verificareAchitareSalariu(salariu){
            if(salariu === 0){
                return "Neachitat"
            }else if(salariu === 1){
                return "Achitat";
            }
        },
        verificareTipAchitare(achitare){
            if(achitare === 0){
                return "Neachitat";
            }else if(achitare === 1){
                return "Card";
            }else if(achitare === 2){
                return "Stat";
            }
        },
        async preluareUserAcces(){
            await axios.get(`/api/users/institutii/acces/${this.user_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.acces_user_institutii = response.data
            })
        },
        async vizualizareSalarii(){
            await axios.get(`/api/salarizare/${this.generare_institutie_id}/vizualizare`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.salarii = response.data.data;
                }
            )
        }

    }
}
</script>

<style scoped>

tr.salariu_neachitat{
    color: #e71e1e;
}
tr.salariu_achitat{
    color: #38ada9;
}
</style>
