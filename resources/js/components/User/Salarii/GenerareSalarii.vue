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
                                v-model="institutie_id"
                            >
                                <option v-for="aui in acces_user_institutii" :value="aui.id">{{ aui.institutie_denumire}}</option>
                            </select>
                        </div>
                    </div>
                    <div
                        class="col-12 my-3 p-2 bg-danger text-center text-white"
                        v-if="generare_erori.institutie_neselectata === true"
                    >
                        Nu ati selectat institutia, va rugam sa selectati!
                    </div>
                    <div class="col-4">
                        <button
                            class="btn btn-primary btn-sm"
                            @click.prevent="preluareSalarii"
                            :disabled="institutie_id == 0"
                        >Generare Salarii</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pozitie</th>
                                <th scope="col">Functie</th>
                                <th scope="col">Angajat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Achita</th>
                                <th scope="col">Stare</th>
                                <th scope="col">CASS Taxa</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pozitie, index) in pozitii">
                                    <th scope="row">{{  index + 1 }}</th>
                                    <td>{{ pozitieNumarValidare(pozitie.pozitie)}}</td>
                                    <td>{{ pozitie.functie}}</td>
                                    <td>{{ pozitie.angajat}}</td>
                                    <!-- Regiune Generare Salariu -->
                                    <td v-if="pozitie.status !== null && pozitie.status.length > 0">{{ pozitie.status[0].s_end_date}}</td>
                                    <td v-else>
                                        <button
                                            class="btn btn-outline-primary btn-sm"
                                            @click.prevent="genereazaSalariu(pozitie)"
                                        >Generare Salariu</button>
                                    </td>
                                    <!-- Regiune Achitare Salariu -->
                                    <td v-if="pozitie.status !== null && pozitie.status.length > 0">
                                        <button
                                            class="btn btn-outline-success btn-sm"
                                            @click.prevent="achitaSalariu(pozitie.status)"
                                            :disabled="pozitie.status[0].s_achitat == 1"
                                        >Achita Salariu</button>
                                    </td>
                                    <td v-else style="color: red; font-weight: bold">
                                        Nu este generat
                                    </td>
                                    <td
                                        v-if="pozitie.status[0] !== undefined "
                                        :class="pozitie.status[0].s_achitat === 0 ? 'sal_neachitat' : 'sal_achitat' "
                                    >{{ pozitie.status[0].s_achitat === 0 ? 'Neachitat' : 'Achitat'}}</td>
                                    <td class="text-center">5.55%</td>
                                </tr>
                            </tbody>
                        </table>
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
            acces_user_institutii: [],
            institutie_id: 0,
            generare_erori:{
                institutie_neselectata: false
            },
            salarii_status: 0,
            pozitii: null,
            loading: false
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
        pozitieNumarValidare(pozitie){
            if(pozitie < 10){
                return `000${pozitie}`;
            }else if(pozitie > 10 & pozitie < 100){
                return `00${pozitie}`;
            }else if(pozitie > 100 & pozitie < 1000){
                return `0${pozitie}`
            }
        },
        async preluareUserAcces(){
            await axios.get(`/api/users/institutii/acces/${this.user_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.acces_user_institutii = response.data
            })
        },
        async preluareSalarii(){
            this.loading = true;
            await axios.get(`/api/salarizare/${this.institutie_id}/generare`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.pozitii = response.data.data;
                    this.loading = false;
                }
            )
        },
        async achitaSalariu(salariuDeModificat){
            await axios.post(`/api/salarizare/achitare`, {
                salariu: salariuDeModificat
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            })
            .then(response => {
                this.preluareSalarii();
                if(response.data.code_message === 'salariu_achitat'){
                    Vue.$toast.open({
                        message: 'Salariu Achitat',
                        type: 'success',
                        // all of other options may go here
                    });
                }
            })
        },
        async genereazaSalariu(pozitie){
            this.loading = true;
            const pozitie_stat  = pozitie.pozitie;
            const institutie_id = this.institutie_id;

            await axios.post("/api/salarizare/generare", {
                institutie: institutie_id,
                pozitie: pozitie_stat
            },{
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                if(response.data.code_message == 'pontaj_inexistent'){
                    Vue.$toast.open({
                        message: 'Angajatul nu si-a introdus pontajul!',
                        type: 'error',
                        // all of other options may go here
                    });
                }else if(response.data.code_message == 'pontaj_neaprobat'){
                    Vue.$toast.open({
                        message: 'Pontajul nu este aprobat',
                        type: 'warning',
                        // all of other options may go here
                    });
                }
                this.preluareSalarii();
                this.loading = false;
            })
        }

    }
}
</script>

<style scoped>
.sal_neachitat{
    color: #d63031;
    font-weight: bold;
}
.sal_achitat{
    color: #00b894;
    font-weight: bold;
}
</style>
