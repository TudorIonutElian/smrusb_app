<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="!loading">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text mx-2" id="basic-addon1">Institutia</span>
                            <select
                                class="form-control form-select mr-1"
                                id="angajat_judet_domiciliu"
                                v-model="institutie_id"
                                @change="verificareStat()"
                            >
                                <option v-for="institutie in institutii" :value="institutie.institutie_id">{{ institutie.institutie_denumire}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row row-bordered-red" v-if="institutia_are_stat_aprobat">
                    <div class="col-12 p-2 text-center">Institutia are deja un stat aprobat, il puteti modifica
                        <span><a :href="'/admin/stat/modificare/' + institutie_id">aici </a></span>
                    </div>
                </div>
                <div class="row" v-if="!institutia_are_stat_aprobat">
                    <div class="col-12 p-2">
                        <div class="col-flex-info">
                            <div class="col-flex-info_left pr-3">Numar posturi aprobate: </div>
                            <div class="col-flex-info_center mr-1">
                                <input
                                    type="number"
                                    class="form-control text-center"
                                    placeholder="Numar total de posturi aprobate"
                                    v-model="stat_organizare_nou.so_numar_posturi_aprobate"
                                >
                            </div>
                            <div class="col-flex-info_right">
                                <button
                                    class="btn btn-block btn-outline-success"
                                    @click.prevent="creeazaStat"
                                >
                                    Creaza Stat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-bordered-finalizare" v-if="operatiune_finalizata">
                    <div class="col-12 p-2 text-center">Statul a fost creat cu succes.
                    </div>
                </div>
            </div>
        </div>
        <loading-component v-if="loading"></loading-component>
    </div>
</template>

<script>
import TopNav from '../../Menus/TopNav'
import LoadingComponent from '../../HelperComponents/LoadingComponent.vue'

export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            user_id: JSON.parse(localStorage.getItem('user')).id,
            institutii: [],
            institutie_id: null,
            loading: false,
            institutia_are_stat_aprobat: false,
            stat_organizare_nou:{
                so_numar_posturi_aprobate: null
            },
            operatiune_finalizata: false
        }
    },
    components:{
        TopNav,
        LoadingComponent
    },
    created(){
        this.preluareInstitutiiAdmin();
    },
    methods:{
        async preluareInstitutiiAdmin(){
            this.operatiune_finalizata = false;
            this.loading = true
            await axios.get('/api/admin/institutii/creare_stat', {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                this.institutii = response.data.data;
                this.loading = false;
            })
        },
        async verificareStat(){
            this.operatiune_finalizata = false;
            await axios.get(`/api/stat/${this.institutie_id}/verificare`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    // Daca nu are stat
                    if(response.data.return_code === 402){
                        this.institutia_are_stat_aprobat = false;
                    }else{
                        this.institutia_are_stat_aprobat = true;
                    }
                }
            )
        },
        async creeazaStat(){
            this.loading = true;
            await axios.post(`/api/stat/${this.institutie_id}/creare`, {
                stat: this.stat_organizare_nou,
                so_institutie_id: this.institutie_id
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                if(response.data.code === 2000){
                    this.operatiune_finalizata = true;
                    this.loading = false;
                }
            })
        }
    }
}
</script>

<style scoped>

.row-bordered-red{
    border: 1px solid;
    border-color: #e55039;
    border-radius: 5px;
    color: #fff;
    background-color: #ED4C67;
}
.row-bordered-red span a{
    display: inline-block;
    background-color: #fff;
    color: #ED4C67;
    padding: 5px;
    border-radius: 3px;
    text-decoration: none;
    width: 50px;
}
.row-bordered-finalizare{
    background-color: #12CBC4;
    font-weight: bold;
    color: #fff;
    padding: 3px;
    border-radius: 3px;
}
.col-flex-info{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.col-flex-info_left{
    width: 10%;
    text-align: right;
}
.col-flex-info_center{
    width: 80%;
}
.col-flex-info_right{
    width: 10%;
}
</style>
