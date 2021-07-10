<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="loading === false">
            <div class="container-fluid mt-4 container-angajati">
                <div class="row">
                    <div class="col-12">
                        <span class="col-12-badge mb-3">
                            Situatii financiare CASS Neachitat
                        </span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <label for="selectare_institutie">Selectat Institutia</label>
                        <select class="form-select form-control" aria-label="Default select example" id="selectare_institutie" v-model="filtrare.institutie">
                            <option v-for="i in institutii" :value="i.id">{{ i.institutie_denumire }}</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="selectare_data_start">Selectat data inceput</label>
                        <input
                            type="date"
                            class="form-control"
                            id="selectare_data_start"
                            :disabled="filtrare.institutie === 0"
                            v-model="filtrare.dela"
                        >
                    </div>
                    <div class="col-3">
                        <label for="selectare_data_sfarsit">Selectat data sfarsit</label>
                        <input
                            type="date"
                            class="form-control"
                            id="selectare_data_sfarsit"
                            :disabled="filtrare.institutie === 0"
                            v-model="filtrare.panala"
                        >
                    </div>
                    <div class="col-3">
                        <label for="selectare_data_start">Filtrare</label>
                        <button
                            class="btn btn-block btn-primary"
                            :disabled="filtrare.institutie === 0"
                            @click.prevent="preluareCassNeachitat"
                        >Filtreaza</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr class="bg-secondary">
                                <th scope="col">#</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Angajat</th>
                                <th scope="col">Salariu</th>
                                <th scope="col">Valoare CASS</th>
                                <th scope="col">Data inceput</th>
                                <th scope="col">Data sfarsit</th>
                                <th scope="col">Stare</th>
                                <th scope="col">Actiune</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(c, index) in cass_list">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ c.cass_institutie }}</td>
                                    <td>{{ c.cass_angajat }}</td>
                                    <td>{{ c.cass_salariu }} lei</td>
                                    <td>{{ c.cass_suma }} lei</td>
                                    <td>{{ c.cass_start_date }}</td>
                                    <td>{{ c.cass_end_date }}</td>
                                    <td style="color: red; font-weight: bold;">Neachitat</td>
                                    <td>
                                        <button
                                            class="btn btn-outline-success btn-sm"
                                            @click.prevent="achitaCassIndividual(c.cass_id)"
                                        >Achita</button>
                                    </td>
                                </tr>
                                <tr v-if="cass_list.length == 0">
                                    <td colspan="9" class="bg-warning text-center">Nu exista CASS Neachitat pentru perioada de referinta.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="loading === true">
            <loading-component></loading-component>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
import LoadingComponent from "../../HelperComponents/LoadingComponent";

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            institutii: [],
            loading: false,
            filtrare: {
                institutie: 0,
                dela: null,
                panala: null
            },
            cass_list: []
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
        async achitaCassIndividual(cass_id){
            this.loading = true;
            await axios.post(`/api/salarizare/cass/neachitat/achitare`, {
               id : cass_id
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.preluareCassNeachitat();
                    this.loading = false;
                }
            );
        },
        async preluareCassNeachitat(){
            this.loading = true;
            await axios.get(`/api/salarizare/cass/neachitat/${this.filtrare.institutie}/${this.filtrare.dela}/${this.filtrare.panala}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.cass_list = response.data.data;
                    this.loading = false;
                }
            )
        },
        async preluareAcces(){
            this.loading = true;
            await axios.get("/api/users/institutii/acces/" + this.user.id, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.institutii = response.data;
                    this.loading = false;
                }
            )
        },
    }
}
</script>

<style scoped>
.input-group{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
}
tr.bg-secondary{
    font-weight: bolder;
    color: #fff;
}
span.col-12-badge{
    display: inline-block;
    padding: 8px;
    background-color: #6c5ce7;
    color: #fff;
    font-weight: bolder;
    border-radius: 4px;
}
.btn-success,
.btn-primary{
    background-color: #6c5ce7!important;
    outline: none;
    border: none;
}
.btn-outline-success{
    background-color: transparent!important;
    color: #000;
    border: 1px solid #6c5ce7;
}
.btn-outline-success:hover{
    background-color: #6c5ce7!important;
    color: #fff;
}
</style>
