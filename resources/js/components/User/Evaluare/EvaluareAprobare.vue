<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 info-col-row">
                        Aprobare evaluari care nu au fost contestate!
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
                                <label>Preluare</label>
                                <button
                                    class="btn btn-success"
                                    :disabled="data.institutie == null"
                                    @click.prevent="preluareCalificative"
                                >Preluare </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="loading === true">
                    <div class="col-12">
                        <loading-component></loading-component>
                    </div>
                </div>
                <div class="row" v-if="data.loaded === true">
                    <div class="col-12 my-3">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Angajat</th>
                                <th scope="col">De la</th>
                                <th scope="col">Pana la</th>
                                <th scope="col">Calificativ Final</th>
                                <th scope="col">Data adaugarii</th>
                                <th scope="col">Aprobare</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(c, index) in data.calificative">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ c.ca_institutie }}</td>
                                <td>{{ c.ca_angajat_nume}} {{ c.ca_angajat_prenume }}</td>
                                <td>{{ c.ca_data_inceput }}</td>
                                <td>{{ c.ca_data_sfarsit }}</td>
                                <td>
                                    <select
                                        class="form-control form-select"
                                        aria-label="Default select example"
                                        v-model="data.calificativ_final"
                                    >
                                        <option value="1">Excelent</option>
                                        <option value="2">Foarte Bine</option>
                                        <option value="3">Bine</option>
                                        <option value="4">Satisfacator</option>
                                        <option value="5">Nesatisfacator</option>
                                        <option value="6">Neevaluat</option>
                                    </select>
                                </td>
                                <td>{{ c.ca_data_adaugarii}}</td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-success"
                                        @click.prevent="aprobareCalificativ(c.ca_id)"
                                    >Aproba Calificativ</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-center">Nu exista calificative neaprobate</td>
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

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
            data: {
                institutii: null,
                institutie: null,
                calificative: null,
                calificativ_final: null,
                loaded: false,
                loading: false,
                token: localStorage.getItem('token')
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
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.data.institutii = response.data
                    this.loading = false
                }
            )
        },
        // Preluare toate calificativele care nu au contestatie si pot fi aprobate
        async preluareCalificative(){
            this.loading = true;
            await axios.get(`/api/calificative/neaprobate/institutie/${this.data.institutie}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.data.token
                }
            }).then(response => {
                    this.data.calificative = response.data.data;
                    this.data.loaded = true;
                    this.loading = false;
                }
            )
        },
        // Aprobare calificativ
        async aprobareCalificativ(id){
            this.loading = true;
            await axios.put(`/api/calificative/aprobare`, {
                idCalificativ: id,
                user_id: this.user.id,
                calificativFinal: this.data.calificativ_final
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.data.token
                }
            }).then(async (response) => {
                    await this.preluareCalificative();
                    this.data.loaded = true;
                    this.loading = false;
                }
            )
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
</style>
