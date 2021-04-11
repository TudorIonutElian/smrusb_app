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
                                v-model="institutie_stat"
                                @change="preluarePozitiiStat"
                            >
                                <option v-for="aui in acces_user_instutii" :value="aui.id">{{ aui.institutie_denumire}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <table class="table">
                            <thead>
                            <tr class="bg-success text-white">
                                <th scope="col">Pozitie</th>
                                <th scope="col">Data Creare</th>
                                <th scope="col">Cuprins</th>
                                <th scope="col">Functie</th>
                                <th scope="col">Actiune</th>

                            </tr>
                            </thead>
                            <tbody>
                                <tr v-if="pozitii.length === 0">
                                    <td colspan="5" class="bg-danger text-white text-center">Nu ati selectat stat sau nu sunt pozitii vacante!</td>
                                </tr>
                                <tr v-for="p in pozitii">
                                    <td>{{ pozitieNumarValidare(p.pozitie_pozitie) }}</td>
                                    <td>{{ p.pozitie_data_creare}}</td>
                                    <td>{{ p.pozitie_cuprins}}</td>
                                    <td>{{ p.pozitie_functie}}</td>
                                    <td><button class="btn btn-sm btn-danger" @click.prevent="radierePozitie(p.id)">Radiere</button></td>
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
            loading: false,
            acces_user_instutii: [],
            institutie_stat: 0,
            pozitii: []
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
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response =>{
                this.acces_user_instutii = response.data
            })
        },
        async preluarePozitiiStat(){
            await axios.get(`/api/pozitii/${this.institutie_stat}/radiere`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response =>{
                this.pozitii = response.data.data
            })
        },
        async radierePozitie(pozitie){
            await axios.post(`/api/pozitii/radiere`, {
                pozitie_id: pozitie
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response =>{
                this.preluarePozitiiStat();
                console.log(response)
            })
        }
    }
}
</script>

<style scoped>
</style>
