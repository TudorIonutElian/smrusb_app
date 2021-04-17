<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="loading === false">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 my-4">
                        <span
                            class="badge"
                        >Date de plata Angajat {{ this.user.user_first_name + ' ' + this.user.user_last_name }}</span>
                    </div>
                </div>
                <div class="row mt-3 p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_institutie" class="form-label">Tip Plata</label>
                        <select
                            class="form-control form-select"
                            id="angajat_institutie"
                            v-model="date_plata.dp_tip_plata"
                            @change="preluareBanci"
                        >
                            <option value="1">Card Bancar</option>
                            <option value="2">Casierie</option>
                        </select>
                    </div>
                    <div class="col-12 col-12-flexed form-group" v-if="date_plata.dp_tip_plata == 1">
                        <label for="angajat_banca" class="form-label">Banca</label>
                        <select
                            class="form-control form-select"
                            id="angajat_banca"
                            v-model="date_plata.dp_banca_id"
                        >
                            <option v-for="banca in banci" :value="banca.id">{{ banca.db_denumire}}</option>
                        </select>
                    </div>
                </div>
                <div class="row p-1 mt-2">
                    <div class="col-12 col-12-flexed" >
                        <label for="numar_act_mutare" class="form-label">CONT IBAN: </label>
                        <input
                            type="text"
                            class="form-control"
                            id="numar_act_mutare"
                            v-model="date_plata.dp_cont_iban"
                        >
                    </div>
                </div>
                <div class="row p-1 mt-2">
                    <div class="col-12 col-12-flexed" >
                        <label for="titular_cont_bancar" class="form-label">Titular cont bancar: </label>
                        <input
                            type="text"
                            class="form-control"
                            id="titular_cont_bancar"
                            v-model="date_plata.dp_titular_cont"
                        >
                    </div>
                </div>
                <div class="row p-1 mt-2">
                    <div class="col-12 col-12-flexed-right" >
                        <button
                            class="btn btn-outline-primary"
                            @click.prevent="salvareDateBancare"
                        >Salveaza datele</button>
                    </div>
                </div>
            </div>
        </div>
        <loading-component v-if="loading === true"></loading-component>
    </div>
</template>

<script>
import TopNav from '../../Menus/TopNav'
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
            date_plata: {
                dp_tip_plata: 0,
                dp_banca_id: 0,
                dp_cont_iban: "",
                dp_titular_cont: JSON.parse(localStorage.getItem('user')).user_first_name + ' ' + JSON.parse(localStorage.getItem('user')).user_last_name,
                dp_angajat: JSON.parse(localStorage.getItem('user')).id
            },
            banci: []
        }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    computed:{
        dateBancareValide: function (){
            if(this.date_plata.dp_tip_plata != 0 & this.date_plata.dp_cont_iban != "" & this.date_plata.dp_titular_cont != ""){
                return true;
            }
            return false;
        }
    },
    methods:{
        async preluareBanci(){
            if(this.date_plata.dp_tip_plata == 1){
                this.loading = true;
                await axios.get("/api/salarizare/datebanci/preluare", {
                    headers:{
                        ContentType: 'application/json',
                        Authorization : 'Bearer ' + this.token
                    }
                }).then(response => {
                    this.banci = response.data;
                    this.loading = false;
                })
            }
        },
        async salvareDateBancare(){
            if(this.dateBancareValide){
                await axios.post("/api/angajati/datebancare", {
                    date: this.date_plata,
                }, {
                    headers:{
                        ContentType: 'application/json',
                        Authorization : 'Bearer ' + this.token
                    }
                }).then(response =>{
                    console.log(response.data)
                   if(response.data.cod_raspuns === 1000){
                       Vue.$toast.open({
                           message: 'Datele de plata au fost salvate.',
                           type: 'succes',
                           // all of other options may go here
                       });
                   }else if(response.data.cod_raspuns === 500){
                       Vue.$toast.open({
                           message: 'Eroare la salvarea datelor.',
                           type: 'error',
                           // all of other options may go here
                       });
                   }else if(response.data.cod_raspuns === 300){
                       Vue.$toast.open({
                           message: 'Aveti deja metoda de plata setata.',
                           type: 'error',
                           // all of other options may go here
                       });
                   }
                })
            }else{
                Vue.$toast.open({
                    message: 'Datele de plata nu sunt valide',
                    type: 'warning',
                    // all of other options may go here
                });
            }
        }
    }
}
</script>

<style scoped>
span.badge{
    padding: 10px;
    background-color: #3498db;
    font-size: 16px;
    color: #fff;
}
.col-12-flexed{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}
.col-12-flexed label{
    width: 20%;
    color: #04ccf6;
    font-weight: bold;
    text-align: right;
    padding-right: 10px;
}
.col-12-flexed select{
    width: 100%;
}
.col-12-flexed div {
    width: 20%;
}
.col-12-flexed div.error {
    width: 80%;
}

.col-12-flexed-right{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-end;
}
</style>
