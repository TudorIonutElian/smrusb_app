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
                                    v-model="filtrare.institutie"
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
                                    v-model="filtrare.dela"
                                >
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="panala">Pana la</label>
                                <input
                                    id="panala"
                                    type="date"
                                    class="form-control"
                                    v-model="filtrare.panala"
                                >
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="panala">Preluare</label>
                                <button
                                    class="btn btn-success"
                                    :disabled="filtrareValida === false"
                                    @click.prevent="preluareIncetariFiltrat"
                                >Preluare </button>
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="panala">Preluare</label>
                                <button
                                    class="btn btn-secondary"
                                    :disabled="filtrare.institutie == null"
                                    @click.prevent="preluareIncetariAstazi"

                                >Afisare Astazi</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr class="bg-info text-white">
                                <th scope="col">#</th>
                                <th scope="col">Numar Contract</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Nume si Prenume</th>
                                <th scope="col">Data angajarii</th>
                                <th scope="col">Data incetarii</th>
                                <th scope="col">Motivul incetarii</th>
                                <th scope="col">Sumar</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ic, index) in incetariContracte" :key="ic.id" v-if="incetariContracte !== null && incetariContracte.length > 0">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ ic.sic_numar_contract}}</td>
                                    <td>{{ ic.sic_institutie}}</td>
                                    <td>{{ ic.sic_angajat}}</td>
                                    <td>{{ ic.sic_data_incepere}}</td>
                                    <td>{{ ic.sic_data_incetare}}</td>
                                    <td>{{ ic.sic_motiv_incetare}}</td>
                                    <td>{{ ic.sic_sumar_incetare}}</td>
                                </tr>
                                <tr v-show="incetariContracte == null || incetariContracte.length == 0">
                                    <td colspan="9" class="faraIncetari">Nu exista incetari ale contractelor de munca pentru perioada selectata</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div v-if="loading === true">
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
            token: localStorage.getItem('token'),
            loading: false,
            institutii: null,
            filtrare: {
                institutie: null,
                dela: null,
                panala: null
            },
            incetariContracte: null
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
        async preluareAcces(){
            this.loading = true;
            await axios.get("/api/users/institutii/acces/" + this.user.id, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.institutii = response.data
                    this.loading = false
                }
            )
        },
        async preluareIncetariFiltrat(){
            this.loading = true;
            await axios.get(`/api/situatii/incetaricontracte/${this.filtrare.institutie}/${this.filtrare.dela}/${this.filtrare.panala}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                this.incetariContracte = response.data.data;
                this.loading = false;
            });
        },
        async preluareIncetariAstazi(){
            this.loading = true;

            await axios.get(`/api/situatii/incetaricontracte/${this.filtrare.institutie}/astazi`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                this.incetariContracte = response.data.data;
                this.loading = false;
            });
        }
    },
    computed:{
      filtrareValida: function(){
          return this.filtrare.institutie != null && this.filtrare.dela != null && this.filtrare.panala != null;
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
</style>
