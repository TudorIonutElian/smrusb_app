<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="loading == false">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 mt-3 mb-4">
                        <span class="recompense-badge">Adaugare recompense angajati</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <select
                            class="form-select form-control"
                            aria-label="Default select example"
                            v-model="institutie_selectata"
                            @change="preluareAngajatiByInstitutie"
                        >
                            <option v-for="i in acces_user_institutii" :value="i.id">{{i.institutie_denumire}}</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select
                            class="form-select form-control"
                            aria-label="Default select example"
                            :disabled="institutie_selectata == 0"
                            v-model="angajat_selectat"
                            @change="preluareRecompense"
                        >
                            <option v-for="a in lista_angajati" :value="a.id">{{a.angajat_nume}} {{ a.angajat_prenume }}</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <button
                            class="btn btn-outline-success btn-block"
                            :disabled="institutie_selectata == 0"
                        >Salvare Recompensa</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <select
                            class="form-select form-control"
                            aria-label="Default select example"
                            :disabled="angajat_selectat == 0"
                        >
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="loading == true">
            <loading-component></loading-component>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
import LoadingComponent from "../../HelperComponents/LoadingComponent";

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            acces_user_institutii: [],
            lista_angajati: [],
            lista_recompense: [],
            institutie_selectata: 0,
            angajat_selectat: 0,
            loading: false
        }
    },
    created() {
        this.preluareUserAcces();
    },
    components:{
        LoadingComponent,
        TopNav,
    },
    methods:{
        async preluareUserAcces(){
            await axios.get(`/api/users/institutii/acces/${this.user.id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.acces_user_institutii = response.data
            })
        },
        async preluareAngajatiByInstitutie(){
            await axios.get(`/api/angajati/preluare_angajati_institutie/${this.institutie_selectata}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.lista_angajati = response.data
            })
        },
        async preluareRecompense(){
            await axios.get(`/api/recompense/all`).then(response =>{
                this.lista_recompense = response.data
            })
        }


    },

}
</script>

<style scoped>
.recompense-badge{
    background-color: #8e44ad;
    padding: 10px;
    border-radius: 4px;
    font-weight: bold;
    color: #fff;
}
button.btn-outline-success{
    background-color: #8e44ad!important;
    font-weight: bold;
    color: #fff;
    border: none;
    outline: none;
}
</style>
