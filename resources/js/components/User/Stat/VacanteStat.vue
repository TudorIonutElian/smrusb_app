<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="!loading">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div
                        class="col-12 bg-suplimentare-stat p-2 text-white text-center">
                        Posturi Vacante</div>
                    <div class="col-12 my-3">
                        <div class="input-group flex-nowrap">
                            <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                            <select
                                class="form-control form-select mr-1"
                                id="angajat_judet_domiciliu"
                                v-model="institutie_id"
                                @change="preluarePosturiVacante"
                            >
                                <option v-for="uic in user_institutii_acces" :value="uic.id">{{ uic.institutie_denumire}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <table class="table">
                            <thead>
                            <tr class="bg-suplimentare-stat text-white">
                                <th scope="col">#</th>
                                <th scope="col">Pozitie</th>
                                <th scope="col">Denumire Cuprins</th>
                                <th scope="col">Denumire Functie</th>
                                <th scope="col">Coeficient Functie</th>
                                <th scope="col">Suma Functie</th>
                                <th scope="col">Data Creare</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(p, index) in posturi_vacante" v-if="posturi_vacante.length > 0">
                                    <th scope="row">{{ index + 1}}</th>
                                    <td>{{ pozitieNumarValidare(p.post_pozitie)}}</td>
                                    <td>{{ p.post_cuprins}}</td>
                                    <td>{{ p.post_functie}}</td>
                                    <td>{{ p.post_coeficient}}</td>
                                    <td>{{ p.post_suma}}</td>
                                    <td>{{ p.post_data_creare}}</td>
                                </tr>
                                <tr v-if="posturi_vacante !== null && posturi_vacante.length === 0">
                                    <td colspan="7" class="posturi_vacante_inexistente">Nu exista posturi vacante.</td>
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
            user_institutii_acces: [],
            institutie_id: 0,
            posturi_vacante: null,
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
        async preluarePosturiVacante(){
            await axios.get(`/api/pozitii/${this.institutie_id}/vacante/stat`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.posturi_vacante = response.data.data;
                }
            )
        }
    }
}
</script>

<style scoped>
.bg-suplimentare-stat{
    background-color: #273c75;
}
.posturi_vacante_inexistente{
    background-color: #ff7675;
    color: #fff;
    font-weight: bolder;
    border-radius: 5px;
    text-align: center;
}
</style>
