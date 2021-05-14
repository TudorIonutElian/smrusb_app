<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 d-flex mb-2">
                        <div class="d-flex mb-3">
                            <div class="d-flex-inner m-2">
                                <label for="institutie">Selectati institutia</label>
                                <select
                                    id="institutie"
                                    class="form-control form-select m-2"
                                    aria-label="Default select example"
                                    v-model="filtrare.institutie">
                                    <option v-for="i in institutii" :key="i.id" :value="i.id">{{ i.institutie_denumire }}</option>
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
                                    @click.prevent="preluareEvaluariFiltrat"
                                    :disabled="filtrareValidata === false"
                                >Preluare </button>
                            </div>
                            <div class="d-flex-inner m-2">
                                <label for="panala">Preluare</label>
                                <button
                                    class="btn btn-outline-secondary"
                                    @click.prevent="preluareEvaluariAnPrecedent"
                                >Preluare an curent </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="loading === true">
            <loading-component></loading-component>
        </div>
        <div class="row" v-if="loading === false">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="bg-info text-white">
                        <th scope="col">#</th>
                        <th scope="col">Nume</th>
                        <th scope="col">Prenume</th>
                        <th scope="col">Data angajarii</th>
                        <th scope="col">Vechime in munca</th>
                        <th scope="col">Data inceput</th>
                        <th scope="col">Data sfarsit</th>
                        <th scope="col">Calificativ</th>
                        <th scope="col">Contestatie</th>
                        <th scope="col">Calificativ final</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-if="calificative != null && calificative.length > 0" v-for="(c, index) in calificative">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ c.ca_angajat_nume}}</td>
                            <td>{{ c.ca_angajat_prenume }}</td>
                            <td>{{ c.ca_angajat_dataangajarii }}</td>
                            <td>{{ c.ca_angajat_vechimemunca }} zile</td>
                            <td>{{ c.ca_data_inceput }}</td>
                            <td>{{ c.ca_data_sfarsit }}</td>
                            <td>{{ c.ca_calificativ_initial }}</td>
                            <td>
                                <span v-if="c.ca_are_contestatie == 0">Nu</span>
                                <span v-if="c.ca_are_contestatie == 1">Da</span>
                            </td>
                            <td>{{ c.ca_calificativ_final }}</td>
                        </tr>
                        <tr v-if="calificative != null && calificative.length == 0" class="fara_calificative">
                            <td colspan="10">Nu exista calificative aprobate pentru anul in curs!</td>
                        </tr>
                    </tbody>
                </table>
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
            loading: false,
            token: localStorage.getItem('token'),
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            user: JSON.parse(localStorage.getItem('user')),
            institutii: [],
            filtrare:{
                institutie: null,
                dela: null,
                panala: null
            },
            calificative: null,
        }
    },
    computed:{
        filtrareValidata: function(){
            return  this.filtrare.institutie != null &&
                    this.filtrare.dela != null &&
                    this.filtrare.panala != null;
        }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    created(){
      this.preluareAcces();
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
        async preluareEvaluariFiltrat(){
            await axios.get(`/api/angajati/calificative/${this.filtrare.institutie}/${this.filtrare.dela}/${this.filtrare.panala}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            })
            .then(response => {
                this.calificative = response.data.data;
                this.loading = false;
            })
        },

        async preluareEvaluariAnPrecedent(){
            this.loading = true;
            const date = new Date();
            const year = date.getFullYear();
            const year_precedent = date.getFullYear();

            if(this.filtrare.institutie !== null){
                await axios.get(`/api/angajati/calificative/anprecedent/${year_precedent}/${this.filtrare.institutie}`, {
                    headers:{
                        ContentType: 'application/json',
                        Authorization : 'Bearer ' + this.token
                    }
                }).then(response =>{
                    this.calificative = response.data.data;
                    this.loading = false;
                })
            }else{
                this.loading = false;
                Vue.$toast.open({
                    message: 'Institutia nu este selectata!',
                    type: 'warning',
                    // all of other options may go here
                });
            }

        }
    }
}
</script>

<style scoped>
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
tr.fara_calificative td{
    background-color: #cf6a87;
    text-align: center;
    color: #fff;
    font-weight: bolder;
    border-radius: 4px;
}
</style>
