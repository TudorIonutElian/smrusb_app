<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="loading === false">
            <div class="container mt-4 container-angajati">
                <!-- row profil utilizator -->
                <div class="row mt-2">
                    <div class="col-4 col-profile">
                        <div class="row-profile">
                            <div class="row-profile-template-full p-2">Date Angajat</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Nume</div>
                            <div class="row-profile-info"> {{ date_angajat.angajat_date.angajat_nume }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Prenume</div>
                            <div class="row-profile-info">{{ date_angajat.angajat_date.angajat_prenume }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Data nasterii</div>
                            <div class="row-profile-info">{{ date_angajat.angajat_date.angajat_data_nasterii }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Varsta</div>
                            <div class="row-profile-info">{{ date_angajat.angajat_date.angajat_varsta }} ani</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Institutie</div>
                            <div class="row-profile-info">{{ date_angajat.angajat_institutie }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Functie</div>
                            <div class="row-profile-info" v-if="date_angajat.angajat_functie !== null">{{ date_angajat.angajat_functie }}</div>
                            <div class="row-profile-info" v-if="date_angajat.angajat_functie === null">
                                <span class="angajat_nenumit_info">Nu este numit.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-info p-2 text-center">
                                    Mutare angajat
                                </div>
                                <div class="col-12 p-2">
                                    <form>
                                        <div class="mb-3">
                                            <label for="numar_act_mutare" class="form-label">Numarul actului administrativ: </label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="numar_act_mutare"
                                                v-model="incetare_contract.numar_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_emitere_act" class="form-label">Data emitere act administrativ: </label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="data_emitere_act"
                                                v-model="incetare_contract.data_emitere_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_aplicare_act" class="form-label">Data aplicare act administrativ: </label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="data_aplicare_act"
                                                v-model="incetare_contract.data_aplicare_act_administrativ">
                                        </div>
                                        <div class="mb-3" v-if="motive_incetare !== null">
                                            <label for="mutare_angajat_institutie" class="form-label">Selectati motiv incetare: </label>
                                            <select
                                                class="form-control form-select"
                                                id="mutare_angajat_institutie"
                                                v-model="incetare_contract.incetare_motiv"
                                            >
                                                <option v-for="mic in motive_incetare" v-bind:value="mic.id">{{ mic.mic_denumire }}</option>
                                            </select>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-block"
                                            @click.prevent="incetareContract()"
                                            v-bind:disabled="incetareValida === false"
                                        >Incetare Contract</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <loading-component v-if="loading === true"></loading-component>
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
            angajat_id: this.$route.params.id,
            date_angajat: {
                angajat_date:{},
                angajat_functie: null,
                angajat_institutie: 'Nu este numit!',
            },
            incetare_contract:{
                numar_act_administrativ: "",
                data_emitere_act_administrativ: "",
                data_aplicare_act_administrativ: "",
                incetare_motiv: 0
            },
            motive_incetare: null,
            // variabile de ajutor
            loading: false,

        }
    },
    created(){
        this.preluareAngajat();
        this.preluareMotive();
    },
    computed:{
      incetareValida: function(){
          return this.incetare_contract.numar_act_administrativ != "" && this.incetare_contract.data_emitere_act_administrativ != "" && this.incetare_contract.data_aplicare_act_administrativ != "" && this.incetare_contract.incetare_motiv != 0;
      }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    methods:{
        async preluareAngajat(){
            this.loading = true;
            await axios.get(`/api/angajati/mutare/${this.angajat_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                this.date_angajat.angajat_date          = response.data.angajat_date;
                this.date_angajat.angajat_functie       = response.data.angajat_functie ? response.data.angajat_functie: this.date_angajat.angajat_functie;
                this.date_angajat.angajat_institutie    = response.data.angajat_institutie;
                this.loading = false;
            });
        },
        async preluareMotive(){
            this.loading = true;
            await axios.get(`/api/user/incetarecontract/preluare`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                this.motive_incetare = response.data
                this.loading = false;
            });
        },
        async incetareContract(){
            const date_incetare = {};
            date_incetare.id_angajat                        = this.angajat_id;
            date_incetare.numar_act_administrativ           = this.incetare_contract.numar_act_administrativ;
            date_incetare.data_emitere_act_administrativ    = this.incetare_contract.data_emitere_act_administrativ;
            date_incetare.data_aplicare_act_administrativ   = this.incetare_contract.data_aplicare_act_administrativ;
            date_incetare.motiv_incetare                    = this.incetare_contract.incetare_motiv;

            await axios.post(`/api/angajati/incetarecontract`, {
                date: date_incetare
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                if(response.data.cod_raspuns == 2000){
                    Vue.$toast.open({
                        message: 'Contractul a fost incheiat cu succes!',
                        type: 'success',
                        // all of other options may go here
                    });
                    router.push({name: 'user-dashboard'});
                }
            });
        }
    }
}
</script>

<style scoped>
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
.col-info{
    padding: 10px;
    color: #04ccf6;
    font-weight: bold;
}
.col-table table.table{
    max-width: 100%;
    box-sizing: border-box;
}
.angajat_nenumit_info{
    color: #d63031;
    font-weight: bolder;
}
</style>
