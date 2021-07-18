<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container-fluid mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="d-flex mb-3">
                            <div class="d-flex-inner m-2">
                                <label for="institutie">Selectati institutia</label>
                                <select
                                    id="institutie"
                                    class="form-control form-select m-2"
                                    aria-label="Default select example"
                                    v-model="helperVariables.filtrare.institutie"
                                >
                                    <option v-for="(i, index) in institutii" :value="i.id">{{ i.institutie_denumire}}</option>
                                </select>
                            </div>

                            <div class="d-flex-inner m-2">
                                <label for="dela">De la </label>
                                <input
                                    id="dela"
                                    type="date"
                                    class="form-control"
                                    :disabled="helperVariables.filtrare.institutie === null"
                                    v-model="helperVariables.filtrare.dela"
                                >
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="panala">Pana la</label>
                                <input
                                    id="panala"
                                    type="date"
                                    class="form-control"
                                    :disabled="helperVariables.filtrare.institutie === null || helperVariables.filtrare.dela === null"
                                    v-model="helperVariables.filtrare.panala"
                                >
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="panala">Preluare</label>
                                <button
                                    class="btn btn-success"
                                    @click.prevent="preluareMutariFiltrat"
                                >Preluare </button>
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="panala">Preluare</label>
                                <button
                                    class="btn btn-secondary">
                                    Afisare Astazi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2" v-if="filtreFinale">
                    <div class="col-12 text-center text-center-info">
                        <img src="/images/info-icon.png" alt="">
                        <span>
                            Se afiseaza persoanele mutate in cadrul institutiei selectate.
                        </span>
                    </div>
                </div>
                <div class="row" v-if="helperVariables.loading === false">
                    <div class="col-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr class="bg-info text-white">
                                <th scope="col">#</th>
                                <th scope="col">Numar Contract</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Nume si Prenume</th>
                                <th scope="col">Data angajarii</th>
                                <th scope="col">Data Mutarii</th>
                                <th scope="col">Numar act</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="mutatii != null && mutatii.length > 0" v-for="(m, index) in mutatii">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ m.smp_contract }}</td>
                                <td>{{ m.smp_institutie }}</td>
                                <td>{{ m.smp_angajat }}</td>
                                <td>{{ m.smp_data_angajarii }}</td>
                                <td>{{ m.smp_data_aplicare }}</td>
                                <td>{{ m.smp_numar_act }}</td>
                            </tr>
                            <tr v-if="(mutatii == null || mutatii.length == 0)">
                                <td colspan="9" class="faraIncetari">Nu exista mutari de personal sau nu ati selectat filtre!</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div v-if="helperVariables.loading === true">
                <loading-component></loading-component>
            </div>
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
            helperVariables: {
                loading: true,
                filtrare: {
                    institutie: null,
                    dela: null,
                    panala: null
                },
                token: localStorage.getItem('token')
            },
            institutii: null,
            mutatii: null
        }
    },
    created(){
        this.preluareAcces();
    },
    components:{
        LoadingComponent,
        TopNav,
    },
    computed:{
        filtreFinale: function (){
            return this.helperVariables.filtrare.institutie != null &&
                   this.helperVariables.filtrare.dela != null &&
                   this.helperVariables.filtrare.panala != null;
        }
    },
    methods:{
        async preluareAcces(){
            this.loading = true;
            await axios.get("/api/users/institutii/acces/" + this.user.id, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.helperVariables.token
                }
            }).then(response => {
                    this.institutii = response.data;
                    this.helperVariables.loading = false;
                }
            )
        },

        async preluareMutariFiltrat(){
            await axios.get(
                `/api/situatii/mutaripersonal/${this.helperVariables.filtrare.institutie}/${this.helperVariables.filtrare.dela}/${this.helperVariables.filtrare.panala}`,
                {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.helperVariables.token
                }
            }).then(response => {
                    this.mutatii = response.data.data;
                    this.helperVariables.loading = false;
                }
            )
        }
    }
}
</script>

<style scoped>
.col-2 span{
    background-color: #d35400;
    padding: 10px;
    color: #fff;
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
.faraIncetari{
    text-align: center;
    color: #B53471;
    font-weight: bolder;
}
.text-center-info{
    font-weight: bold;
    color: #00b894;
}
</style>
