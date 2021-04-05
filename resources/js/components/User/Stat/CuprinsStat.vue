<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="!loading">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div
                        class="col-12 bg-suplimentare-stat p-2 text-white text-center">
                        Creare Cuprins</div>
                    <div class="col-12 my-3">
                        <div class="input-group flex-nowrap">
                            <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                            <select
                                class="form-control form-select mr-1"
                                id="angajat_judet_domiciliu"
                                v-model="institutie.id"
                                @change="verificareStat"
                            >
                                <option v-for="institutie in user_institutii_acces" :value="institutie.id">{{ institutie.institutie_denumire }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row row-bordered-red my-2" v-show="response.stat_inexistent === true">
                    <div class="col-12 p-2 text-center">
                        Nu exista stat de organizare aprobat pentru aceasta institutie!
                    </div>
                </div>
                <div class="row my-4" v-show="stat !== null">
                    <div class="col-12">
                        <div class="suplimentare-stat">
                            <div class="col-flex-info">
                                <div class="col-flex-info_left p-2 col-flex-info-right">Cuprins</div>
                                <div class="col-flex-info_right p-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Introduceti denumirea cuprinsului"
                                        v-model="cuprins_nou.cn_denumire"
                                    >
                                </div>
                            </div>
                            <div class="col-flex-info">
                                <div class="col-flex-info_left p-2 col-flex-info-right">Ordinea din stat</div>
                                <div class="col-flex-info_right p-2">
                                    <input
                                        type="number"
                                        class="form-control"
                                        placeholder="Introduceti ordinea cuprinsului"
                                        v-model="cuprins_nou.cn_ordine"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <button
                        class="btn btn-block m-3 btn-outline-success"
                        @click.prevent="creazaCuprins"
                    >Creaza Cuprinsul</button>
                </div>
                <div class="row" v-show="status_cuprins === true">
                    <div class="col-12 bg-outline-succes">
                        Cuprinsul a fost creat cu succes.
                    </div>
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
            },
            user_institutii_acces: [],
            loading: false,
            stat: null,
            response:{
                stat_inexistent: false
            },
            cuprins_nou:{
                cn_denumire: "",
                cn_ordine: 0
            },
            status_cuprins: false
        }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    created(){
        this.preluareUserAcces();
    },
    methods:{
        async preluareUserAcces(){
            this.status_cuprins = false;
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
            this.loading = true;
            this.stat = null;
            await axios.get(`/api/stat/${this.institutie.id}/verificare/`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(async (response) => {
                    if(response.data.return_code === 2000){
                        this.stat = response.data.stat[0]
                        this.response.stat_inexistent = false;
                    }else{
                        this.response.stat_inexistent = true;
                    }
                    this.loading = false
                }
            )
        },
        async creazaCuprins(){
            this.status_cuprins = false;
            await axios.post(`/api/cuprins/creare`, {
                cuprins: this.cuprins_nou,
                institutie: this.institutie.id
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(async (response) =>{
               if(response.data.cod_raspuns === 2000){
                   this.status_cuprins = true;
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
    background-color: #ff6b6b;
    border-radius: 5px;
    color: #fff;
}
.row-bordered-green{
    border: 1px solid;
    border-color: #079992;
    border-radius: 5px;
}
.bg-outline-succes{
    border: 1px solid;
    background-color: #079992;
    border-radius: 3px;
    padding: 8px;
    color: #fff;
    text-align: center;
}
</style>
