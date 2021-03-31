<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="!loading">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div
                        class="col-12 bg-suplimentare-stat p-2 text-white text-center">
                        Suplimentare stat de organizare</div>
                    <div class="col-12 my-3">
                        <div class="input-group flex-nowrap">
                            <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                            <select
                                class="form-control form-select mr-1"
                                id="angajat_judet_domiciliu"
                                v-model="institutie.id"
                                @change="verificareStat()"
                            >
                                <option v-for="institutie in user_institutii_acces" :value="institutie.id">{{ institutie.ua_denumire }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row row-bordered-red my-2" v-if="stat_organizare === 0">
                    <div class="col-12 p-2 text-center">
                        Nu exista stat de organizare aprobat pentru aceasta institutie!
                    </div>
                </div>
                <div class="row my-4" v-if="stat_organizare === 1">
                    <div class="col-12 text-center">
                        <div class="col-flex-info">
                            <div class="p-2 col-flex-info-right">Stat ID:</div>
                            <div class="p-2">#{{ stat_organizare_detaliat.stat_id}}</div>
                        </div>
                        <div class="col-flex-info">
                            <div class="p-2 col-flex-info-right">Denumire Institutie :</div>
                            <div class="p-2">{{ stat_organizare_detaliat.stat_institutie}}</div>
                        </div>
                        <div class="col-flex-info">
                            <div class="p-2 col-flex-info-right">Numar posturi <span>aprobate</span> :</div>
                            <div class="p-2">{{ stat_organizare_detaliat.stat_numar_posturi}}</div>
                        </div>
                        <div class="col-flex-info">
                            <div class="p-2 col-flex-info-right">Numar posturi <span>disponibile</span>:</div>
                            <div class="p-2">{{ stat_organizare_detaliat.stat_numar_posturi_disponibile}}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="suplimentare-stat">
                            <div class="col-flex-info">
                                <div class="col-flex-info_left p-2 col-flex-info-right">Pozitie</div>
                                <div class="col-flex-info_right p-2">
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="institutie.pozitie.ps_pozitie"
                                        @change="verificarePozitie"
                                    >
                                    <div class="pl-2 pozitie_existenta" v-if="erori.eroare_pozitie_existenta">Eroare: pozitia exista deja</div>
                                </div>

                            </div>
                            <div class="col-flex-info">
                                <div class="col-flex-info_left p-2 col-flex-info-right">Cuprins</div>
                                <div class="col-flex-info_right p-2">
                                    <select
                                        class="form-control form-select mr-1"
                                        id="cuprins_suplimentare_stat"
                                        v-model="institutie.pozitie.ps_cuprins"
                                    >
                                        <option v-for="c in this.stat_organizare_detaliat.cuprins" :value="c.id">
                                            {{ c.sc_denumire }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-flex-info">
                                <div class="col-flex-info_left p-2 col-flex-info-right">Functie</div>
                                <div class="col-flex-info_right p-2">
                                    <select
                                        class="form-control form-select mr-1"
                                        id="cuprins_suplimentare_stat_functie"
                                        v-model="institutie.pozitie.ps_functie"
                                    >
                                        <option v-for="functie in functii" :value="functie.id">
                                            {{ functie.functie_coeficient }} - {{ functie.functie_suma}} - {{ functie.functie_denumire }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button
                        class="btn btn-block m-3 btn-outline-success"
                        @click.prevent="suplimenteazaPozitie"
                    >Suplimentare Stat Organizare
                    </button>
                </div>
            </div>
        </div>
        <loading-component v-if="loading"></loading-component>
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
            institutie:{
                id: "",
                pozitie: {
                    ps_stat: null,
                    ps_pozitie: null,
                    ps_cuprins: null,
                    ps_functie: null,
                    ps_angajat: null,
                    ps_data_numire: null
                }
            },
            user_institutii_acces: [],
            stat_organizare: null,
            stat_organizare_detaliat: {},
            loading: false,
            erori: {
                eroare_pozitie_existenta: false
            },
            functii: []
        }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    created(){
        this.preluareFunctii();
        this.preluareUserAcces();
    },
    methods:{
        async preluareFunctii(){
            await axios.get("/api/functii/preluare", {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                this.functii = response.data;
            });
        },
        async preluareUserAcces(){
            this.loading = true;
            const user_id = JSON.parse(localStorage.getItem('user')).id;
            await axios.get("/api/users/institutii/acces/" + user_id, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.user_institutii_acces = response.data
                    this.loading = false
                }
            )
        },
        async verificareStat(){
            this.stat_organizare = null;
            this.loading = true;
            await axios.get(`/api/stat/${this.institutie.id}/verificare`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(async (response) => {
                    if(response.data.return_code !== 402){
                        // Setare stat pe codul 0 pentru afisare warning
                        this.stat_organizare_detaliat = response.data.stat[0]
                        this.stat_organizare = 1
                        this.institutie.pozitie.ps_stat = this.stat_organizare_detaliat.stat_id
                        this.loading = false

                        // preluare cuprins stat
                        await axios.get(`/api/cuprins/${this.institutie.id}/preluare`, {
                            headers:{
                                ContentType: 'application/json',
                                Authorization : 'Bearer ' + this.token
                            }
                        }).then(response => {
                            this.stat_organizare_detaliat.cuprins = response.data;
                        });

                    }else if(response.data.return_code === 402){
                        this.stat_organizare = 0;
                        this.loading = false;
                    }
                }
            )
        },
        async verificarePozitie(){
            this.erori.eroare_pozitie_existenta = false;
            await axios.get(`/api/pozitii/${this.stat_organizare_detaliat.stat_id}/verificare/${this.institutie.pozitie.ps_pozitie}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                if(response.data === 1){
                    this.erori.eroare_pozitie_existenta = true;
                }else{
                    this.erori.eroare_pozitie_existenta = false;
                }
            })
        },
        async suplimenteazaPozitie(){
            await axios.post(`/api/pozitii/suplimentare`, {
                pozitie: {
                    ps_stat: this.institutie.pozitie.ps_stat,
                    ps_pozitie: this.institutie.pozitie.ps_pozitie,
                    ps_functie: this.institutie.pozitie.ps_functie,
                    ps_cuprins: this.institutie.pozitie.ps_cuprins
                }
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                if(response.data.cod_raspuns === 2000){
                    router.push({name: 'vizualizare-stat'});
                }
            })
        }
    }
}
</script>

<style scoped>
.bg-suplimentare-stat{
    background-color: #4a69bd;
}
.col-flex-info{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.col-flex-info-right{
    text-align: right;
    width: 17%;
    font-weight: bold;
}
.col-flex-info_right{
    width: 80%;
}
.col-flex-info-right span{
    color: #079992;
}
.row-bordered-red{
    border: 1px solid;
    border-color: #e55039;
    border-radius: 5px;
}
.row-bordered-green{
    border: 1px solid;
    border-color: #079992;
    border-radius: 5px;
}
.pozitie_existenta{
    font-weight: bold;
    color: #e55039;
}
</style>
