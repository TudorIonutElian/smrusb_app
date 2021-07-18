<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="loading === true">
            <loading-component></loading-component>
        </div>
        <div class="row" v-if="loading === false">
            <div class="container mt-4 container-angajati">
                <div class="row my-4">
                    <div class="col-12 col-flexed">
                        <span class="p-2 text-white text-center">Formular adaugare Date Evaluare</span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 col-profile">
                        <div class="row-profile">
                            <div class="row-profile-template-full p-2">Date Angajat</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Nume</div>
                            <div class="row-profile-info"> {{ this.angajat.angajat_nume}} </div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Prenume</div>
                            <div class="row-profile-info">{{ this.angajat.angajat_prenume}}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Data nasterii</div>
                            <div class="row-profile-info">{{ this.angajat.angajat_data_nasterii}} </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 d-flex-inner">
                                    <label for="dela">De la </label>
                                    <input
                                        id="dela"
                                        type="date"
                                        class="form-control"
                                        v-model="date_evaluare.dela"
                                    >
                                </div>
                                <div class="col-3 d-flex-inner">
                                    <label for="eDataPanala">Pana la</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="date_evaluare.panala"
                                        id="eDataPanala"
                                        @change="validaredataPanaLa"
                                    >
                                </div>
                                <div class="col-3 d-flex-inner">
                                    <label for="calificativ">Selectati calificativul</label>
                                    <select
                                        id="calificativ"
                                        class="form-control form-select m-2"
                                        aria-label="Default select example"
                                        v-model="date_evaluare.calificativ"
                                        :disabled="erori.dateInvalide"
                                    >
                                        <option value="1">Excelent</option>
                                        <option value="2">Foarte Bine</option>
                                        <option value="3">Bine</option>
                                        <option value="4">Satisfacator</option>
                                        <option value="5">Nesatisfacator</option>
                                    </select>
                                </div>
                                <div class="col-3 d-flex-inner">
                                    <label for="actiune">Actiune</label>
                                    <button
                                        id="actiune"
                                        class="btn btn-success"
                                        @click.prevent="salvareDateEvaluare"
                                        :disabled="this.dateEvaluareValid === false"
                                    >Salvare Date Evaluare </button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr class="bg-info-evaluare text-white">
                                                <th scope="col">#</th>
                                                <th scope="col">Data inceput</th>
                                                <th scope="col">Data sfarsit</th>
                                                <th scope="col">Calificativ</th>
                                                <th scope="col">Contestatie</th>
                                                <th scope="col">Calificativ final</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(c, index) in angajat.calificative"
                                                :key="c.id"
                                                v-if="angajat.calificative.length > 0"
                                            >
                                                <th scope="row">{{ index + 1}}</th>
                                                <td>{{ c.ca_data_inceput}}</td>
                                                <td>{{ c.ca_data_sfarsit}}</td>
                                                <td>{{ c.ca_calificativ_initial}}</td>
                                                <td>
                                                    <span v-if="c.ca_are_contestatie === 0">Nu</span>
                                                    <span v-if="c.ca_are_contestatie === 1">Da</span>
                                                </td>
                                                <td>{{ c.ca_calificativ_final}}</td>
                                                <td>
                                                    <span class="c_neaprobat" v-if="c.ca_status === 'Calificativ Neaprobat'">{{ c.ca_status}}</span>
                                                    <span class="c_aprobat" v-if="c.ca_status === 'Calificativ Aprobat'">{{ c.ca_status}}</span>
                                                </td>
                                            </tr>
                                            <tr v-if="angajat.calificative.length === 0">
                                                <td
                                                    colspan="7"
                                                    class="text-center"
                                                >
                                                    Angajatul nu are evaluari adaugate.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
            loading: false,
            token: localStorage.getItem('token'),
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            user_id: JSON.parse(localStorage.getItem('user')).id,
            date_evaluare:{
                dela: null,
                panala: null,
                calificativ: null
            },
            angajat: {},
            erori:{
                dateInvalide: true
            }
        }
    },
    computed: {
      dateEvaluareValid: function(){
          return this.date_evaluare.dela != null && this.date_evaluare.panala != null && this.date_evaluare.calificativ != null && this.date_evaluare.dela < this.date_evaluare.panala;
      }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    created(){
        this.preluareDateAngajat();
    },
    methods:{
        async preluareDateAngajat(){
            this.loading = true;
            const id = this.$route.params.id;
            await axios.get(`/api/angajati/${id}/preluaredatecalificativ`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            })
            .then(response => {
                this.angajat = response.data.angajat
                this.angajat.calificative = response.data.calificative
                console.log(response);
                this.loading = false;
            })
        },
        async salvareDateEvaluare(){
            if(this.dateEvaluareValid === true){
                this.loading = true;

                await axios.post(`/api/angajati/calificative/adaugare`, {
                    angajat: this.$route.params.id,
                    evaluare: this.date_evaluare
                }, {
                    headers:{
                        ContentType: 'application/json',
                        Authorization : 'Bearer ' + this.token
                    }
                })
                    .then(response => {
                        if(response.data.cod_raspuns === 500){
                            Vue.$toast.open({
                                message: 'Este deja evaluat pentru aceasta perioada!',
                                type: 'error',
                                // all of other options may go here
                            });
                        }else if(response.data.cod_raspuns === 501){
                            Vue.$toast.open({
                                message: 'Data evaluare < data angajare!',
                                type: 'error',
                                // all of other options may go here
                            });
                        }
                        Vue.$toast.open({
                            message: 'Date Evaluare Salvate!',
                            type: 'success',
                            // all of other options may go here
                        });
                        this.preluareDateAngajat();
                        this.loading = false;
                    })
            }else{
                Vue.$toast.open({
                    message: 'Date Evaluare invalide!',
                    type: 'error',
                    // all of other options may go here
                });

            }
        },
        validaredataPanaLa(){
            if(this.date_evaluare.dela === null){
                document.getElementById("eDataPanala").valueAsDate = null;
                Vue.$toast.open({
                    message: 'Completati perioada de inceput',
                    type: 'error',
                    // all of other options may go here
                });
            }
            if(this.date_evaluare.dela !== null && this.date_evaluare.dela > this.date_evaluare.panala){
                this.erori.dateInvalide = true;
                document.getElementById("eDataPanala").valueAsDate = null;
                Vue.$toast.open({
                    message: 'Perioada invalida, data sfarsit < data inceput!',
                    type: 'error',
                    // all of other options may go here
                });
            }
            this.erori.dateInvalide = false;
        }
    }
}
</script>

<style scoped>
.border-test{
    border: 1px solid red;
          }
.row-profile{
    display: flex;
    flex-direction: row;
    justify-content: space-around;

}
.row-profile-template-full{
    width: 100%;
    text-align: center;
    padding: 5px;
    font-weight: bold;
    color: #04ccf6;
}
.row-profile-template{
    width: 50%;
    text-align: right;
    padding: 5px;
    font-weight: bold;
}
.row-profile-info{
    width: 50%;
    text-align: left;
    padding: 5px;
}
.col-flexed{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.col-flexed span{
    border-radius: 4px;
    background-color: #487eb0;
}
.col-9{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: flex-start;
    align-content: baseline;
}
.d-flex-inner{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.bg-info-evaluare{
    background-color: #487eb0;
}
.c_neaprobat{
    color: #e84118;
    font-weight: bold;
}

.c_aprobat{
    color: #44bd32;
    font-weight: bold;
}
</style>
