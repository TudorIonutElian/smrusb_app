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
                    <div class="col-12">
                        <div class="row row-flexible p-2">
                            <div>
                                <button
                                    class="btn btn-primary"
                                    @click.prevent="vizualizareSalarii"
                                    :disabled="generare_institutie_id === 0"
                                    :class="generare_institutie_id === 0 ? 'bg-danger': ''"
                                >Vizualizare Salarii</button>
                                <button
                                    class="btn btn-success ml-2"
                                    @click.prevent="exportSalariiPDF"
                                    :disabled="generare_institutie_id === 0"
                                    :class="generare_institutie_id === 0 ? 'bg-danger': ''"
                                >Export Salarii PDF</button>
                                <button
                                    class="btn btn-secondary ml-2"
                                    @click.prevent="showHideFilters"
                                    :disabled="generare_institutie_id === 0"
                                    :class="generare_institutie_id === 0 ? 'bg-danger': ''"
                                >Filtrare Salarii</button>
                            </div>
                            <div class="ml-3 form-group-filter" v-if="helperVariables.showFilter">
                                <input type="date" class="form-control form-control-inline" v-model="filtrare.dela">
                                <input type="date" class="form-control form-control-inline" v-model="filtrare.panala">
                                <input type="text" class="form-control form-control-inline" v-model="filtrare.nume" placeholder="Numele angajatului" @keyup="getSalariiByName($event)">
                                <a @click.prevent="resetFilters" class="reset" v-show="filtrare.nume != null && filtrare.nume.length > 0">
                                    <img src="/images/resetFilters.png">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-2">
                        <table class="table" id="my-table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Pozitie</th>
                                <th scope="col">Functie</th>
                                <th scope="col">Angajat</th>
                                <th scope="col">De la: </th>
                                <th scope="col">Pana la: </th>
                                <th scope="col">Suma inititala: </th>
                                <th scope="col">Bonus</th>
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
import { jsPDF } from "jspdf";
import 'jspdf-autotable';

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
            exportable: false,
            helperVariables: {
                showFilter: false
            },
            filtrare:{
                dela: null,
                panala: null,
                nume: null
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
        verificareAchitareSalariu(salariu){
            if(salariu === 0){
                return "Neachitat"
            }else if(salariu === 1){
                return "Achitat";
            }
        },
        verificareTipAchitare(achitare){
            if(achitare === 0){
                return "-";
            }else if(achitare === 1){
                return "-";
            }else if(achitare === 2){
                return "-";
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
            await axios.get(`/api/salarizare/${this.generare_institutie_id}/vizualizare/${this.filtrare.dela}/${this.filtrare.panala}/`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.salarii = response.data.data;
                }
            )
        },
        exportSalariiPDF(){
            const doc = new jsPDF({
                orientation: 'l',
                unit: 'cm',
                format: 'a4',
                putOnlyUsedFonts:true,
            });
            doc.setDrawColor(39, 174, 96);
            doc.text(`SMRUSB - Salarii ${this.acces_user_institutii[this.generare_institutie_id-1].institutie_denumire}`, 2, 2);
            doc.autoTable({
                html: '#my-table',
                startY: 3,
                tableWidth: 'auto',
            })

            doc.save("salarii.pdf");
        },
        showHideFilters(){
            this.helperVariables.showFilter = !this.helperVariables.showFilter;
        },
        async getSalariiByName(event){
            const valoareStringNume = event.target.value;
            if(valoareStringNume === ""){
                await this.vizualizareSalarii();
            }else{
                const salariiFiltrate = [];
                this.salarii.forEach(salariu=>{
                    let salariuLower = salariu.salariu_angajat.toLowerCase();
                    if(salariuLower.includes(valoareStringNume.toLowerCase())){
                        salariiFiltrate.push(salariu)
                    }
                })

                this.salarii = salariiFiltrate;
            }
        },
        async resetFilters(){
            this.filtrare.dela = null;
            this.filtrare.panala = null;
            this.filtrare.nume = null;
            await this.vizualizareSalarii();
        }
    }
}
</script>

<style scoped>
.row-flexible{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
}
.form-control-inline{
    display: inline-block;
}
.form-group-filter{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.form-group-filter .form-control-inline{
    margin: 0 10px;
}
</style>
