<template>
    <div class="row mt-2">
        <div class="col-12" v-if="loading === false">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12 bg-angajat-dashboard">Panou de Control Angajat</div>
                </div>
                <div class="row my-3 row-flex ">
                    <div class="col-3 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2 working">
                            Adrese
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>{{ lista_adrese.data.length }}</span>
                        </div>
                        <div class="my-2">
                            <a :href="`/angajat/adrese/${this.user.user_angajat_id}`" class="btn btn-info btn-block text-white">Vezi Adrese</a>
                        </div>
                    </div>

                    <div class="col-3 offset-1 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2 working">
                            Salarii
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>{{ dataCount.countSalarii }}</span>
                        </div>
                        <div class="my-2">
                            <button class="btn btn-info btn-block text-white">Vezi Salarii</button>
                        </div>
                    </div>

                    <div class="col-3 offset-1 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2 working">
                            Pontaje
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>{{ dataCount.countPontaje }}</span>
                        </div>
                        <div class="my-2">
                            <a :href="`/angajat/pontaje/${this.user.user_angajat_id}`" class="btn btn-info btn-block text-white">Vezi Pontaje</a>
                        </div>
                    </div>

                </div>

                <div class="row my-3 row-flex">
                    <div class="col-3 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2">
                            Calificative
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>{{ dataCount.countCalificative }}</span>
                        </div>
                        <div class="my-2">
                            <a :href="`/user/dashboard/calificativeangajat/${this.user.user_angajat_id}`" class="btn btn-info btn-block text-white">Vezi Calificative</a>
                        </div>
                    </div>

                    <div class="col-3 offset-1 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2 working">
                            Mutatii
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>0</span>
                        </div>
                        <div class="my-2">
                            <button class="btn btn-info btn-block text-white">Vezi Adrese</button>
                        </div>
                    </div>

                    <div class="col-3 offset-1 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2 working">
                            Schimbari Parole
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>0</span>
                        </div>
                        <div class="my-2">
                            <button class="btn btn-info btn-block text-white">Vezi Adrese</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12" v-if="loading === true">
            <loading-component></loading-component>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import LoadingComponent from "../HelperComponents/LoadingComponent";

export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            lista_angajati: [],
            user_id: JSON.parse(localStorage.getItem('user')).id,
            lista_acces: [],
            user: JSON.parse(localStorage.getItem('user')),
            loading: true,
            angajat: {
                calificative: null
            },
            lista_adrese: [],
            dataCount: {
                countAdrese: 0,
                countSalarii: 0,
                countPontaje: 0,
                countCalificative: 0,
                countMutatii: 0,
                countSchimbariParole: 0,
            }
        }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    created(){
        this.preluareAngajati();
        this.preluareAdrese();
        this.preluareSalariiByID();
        this.preluarePontajeByID();
        this.preluareCalificativeByID();
    },
    methods:{
        async preluareAngajati(){
            axios.get(`/api/angajati/${this.user_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.lista_angajati = response.data.data
                this.loading = false;
            })
        },
        async preluareAdrese(){
            this.loading = true;
            axios.get(`/api/angajati/${this.user.user_angajat_id}/adrese`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.lista_adrese = response.data
                this.loading = false;

            })
        },
        async preluareSalariiByID(){
            const angajat_id = this.user.user_angajat_id;
            axios.get(`/api/count/${angajat_id}/salarii`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.dataCount.countSalarii = response.data;
                this.loading = false;

            })
        },
        async preluarePontajeByID(){
            const angajat_id = this.user.user_angajat_id;
            axios.get(`/api/count/${angajat_id}/pontaje`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.dataCount.countPontaje = response.data;
                this.loading = false;

            })
        },
        async preluareCalificativeByID(){
            const angajat_id = this.user.user_angajat_id;
            axios.get(`/api/count/${angajat_id}/calificative`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.dataCount.countCalificative = response.data;
                this.loading = false;

            })
        }

    }
}
</script>

<style scoped>
.btn-show{
    border: none;
}
.bg-angajat-dashboard{
    background-color: #60a3bc;
    color: #fff;
    font-weight: bolder;
    padding: 10px;
}
.row-flex{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.angajat-block{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #dfe6e9;
}
.angajat-bloc_adresa{
    display: block;
    background-color: #60a3bc;
    color: #fff;
    font-weight: bold;
    padding: 5px;
    width: 60%;
    text-align: center;
}
.angajat-bloc_numeric{
    font-size: 3rem;
    color: #60a3bc;
    font-weight: bold;
}

.working{
    background-color: red;
}
</style>
