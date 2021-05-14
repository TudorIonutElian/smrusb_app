<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 info-col-row">
                        Situatie Salarii Lunare
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex mb-2">
                        <div class="d-flex mb-3">
                            <div class="d-flex-inner m-2">
                                <label for="institutie">Selectati institutia</label>
                                <select
                                    id="institutie"
                                    class="form-control form-select m-2"
                                    aria-label="Default select example"
                                    v-model="data.institutie"
                                >
                                    <option v-for="i in data.institutii" :value="i.id">{{ i.institutie_denumire }}</option>
                                </select>
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="institutie">Selectati Trimestrul</label>
                                <select
                                    id="luna"
                                    class="form-control form-select m-2"
                                    aria-label="Default select example"
                                    v-model="data.trimestru"
                                    :disabled="data.institutie == null"
                                >
                                    <option value="01">01 - Trimestrul I</option>
                                    <option value="02">02 - Trimestrul II</option>
                                    <option value="03">03 - Trimestrul III</option>
                                    <option value="04">04 - Trimestrul IV</option>
                                </select>
                            </div>
                            <div class="d-flex-inner m-2">
                                <label>Preluare</label>
                                <button
                                    class="btn btn-success"
                                    :disabled="data.trimestru == null"
                                    @click.prevent="preluareSalarii"
                                >Preluare </button>
                            </div>
                            <div class="d-flex-inner m-2">
                                <label>Export PDF</label>
                                <button
                                    class="btn btn-outline-primary"
                                    :disabled="data.trimestru == null"
                                    @click.prevent="exportSalarii"
                                >Export PDF </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="loading === true">
                    <div class="col-12">
                        <loading-component></loading-component>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-3">
                        <table class="table table-striped" id="salariiGenerate">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Angajat</th>
                                <th scope="col">De la</th>
                                <th scope="col">Pana la</th>
                                <th scope="col">Suma Finala</th>
                                <th scope="col">Achitat</th>
                                <th scope="col">Stat / Card</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="data.salarii != null" v-for="(s, index) in data.salarii">
                                <td>{{ index + 1}}</td>
                                <td>{{ s.salariu_institutie }}</td>
                                <td>{{ s.salariu_angajat }}</td>
                                <td>{{ s.salariu_start_date }}</td>
                                <td>{{ s.salariu_end_date }}</td>
                                <td>{{ s.salariu_suma_finala }}</td>
                                <td>
                                    <span v-if="s.salariu_achitat == 1">Da</span>
                                    <span v-if="s.salariu_achitat == 0">Nu</span>
                                </td>
                                <td>
                                    <span v-if="s.salariu_tip_achitare == 0">Casierie</span>
                                    <span v-if="s.salariu_tip_achitare == 1">Card</span>
                                </td>
                            </tr>
                            <tr class="td-sumar" v-if="this.data.sumar != null">
                                <td colspan="3">Total salarii achitate ::</td>
                                <td colspan="5">{{ this.data.sumar }} -lei</td>
                            </tr>
                            <tr v-if="(this.data.salarii == null) || (this.data.salarii != null && this.data.salarii.length == 0) ">
                                <td colspan="10" class="text-center">Nu exista salarii pentru trimestrul selectat.</td>
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
import LoadingComponent from "../../HelperComponents/LoadingComponent";
import {jsPDF} from "jspdf";
import 'jspdf-autotable';

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
            data: {
                institutii: null,
                institutie: null,
                salarii: null,
                sumar: null,
                loaded: false,
                loading: false,
                token: localStorage.getItem('token'),
                trimestru: null,
            }
        }
    },
    created(){
        this.preluareAcces();
    },
    components:{
        LoadingComponent,
        TopNav,
    },
    methods:{
        // preluare user acces
        async preluareAcces(){
            this.loading = true;
            await axios.get("/api/users/institutii/acces/" + this.user.id, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.data.token
                }
            }).then(response => {
                    this.data.institutii = response.data
                    this.loading = false
                }
            )
        },
        async preluareSalarii(){
            this.loading = true;
            await axios.get(`/api/salarizare/${this.data.institutie}/trimestrial/${this.data.trimestru}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.data.token
                }
            }).then(response => {
                    this.data.salarii = response.data.salarii
                    this.sumarSalarii(this.data.salarii);
                    this.loading = false;

                    Vue.$toast.open({
                        message: 'Datele au fost preluate!',
                        type: 'success',
                        // all of other options may go here
                    });
                }
            )
        },
        exportSalarii(){
            const doc = new jsPDF({
                orientation: 'l',
                unit: 'cm',
                format: 'a4',
                putOnlyUsedFonts:true,
            });
            doc.setDrawColor(39, 174, 96);
            doc.text(`SMRUSB - Salarii`, 2, 2);
            doc.autoTable({
                html: '#salariiGenerate',
                startY: 3,
                tableWidth: 'auto',
            })

            doc.save("salarii.pdf");
        },
        sumarSalarii(salarii){
            salarii.forEach(salariu =>{
                this.data.sumar += salariu.salariu_suma_finala;
            })
        }
    }
}
</script>

<style scoped>
.info-col-row{
    background-color: #2e86de;
    font-weight: bolder;
    color: #fff;
    padding: 10px;
    border-radius: 4px;
}

.d-flex{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
    align-content: center;
}
.d-flex-inner{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.td-sumar {
    background-color: #55efc4!important;
    color: #333;
}
.td-sumar td:nth-child(1){
    text-align: right;
    font-weight: bolder;
}
.td-sumar td:nth-child(2){
    text-align: left;
    font-weight: bolder;
}
</style>
