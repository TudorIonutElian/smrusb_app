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
                            @click.prevent="salvareRecompensaNoua"
                        >Salvare Recompensa</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <select
                            class="form-select form-control"
                            aria-label="Default select example"
                            :disabled="angajat_selectat == 0"
                            v-model="recompensa_selectat"
                        >
                            <option v-for="r in lista_recompense" :value="r.id">{{ r.dr_denumire }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Recompensa</th>
                                <th scope="col">Data acordarii</th>
                                <th scope="col">Data expirarii</th>
                                <th scope="col">Status</th>
                                <th scope="col">Sterge</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-if="lista_recompense_angajat.length > 0 && lista_recompense_angajat_preluate == true"
                                v-for="(lr, index) in lista_recompense_angajat">
                                <th scope="row">{{ index + 1}}</th>
                                <td>{{ lr.denumire }}</td>
                                <td>{{ lr.data_acordarii }}</td>
                                <td>{{ lr.data_expirarii }}</td>
                                <td>
                                    <span v-if="lr.status == 1" class="recompensa-activa">Activa</span>
                                    <span v-if="lr.status == 0" class="recompensa-inactiva">Inactiva</span>
                                </td>
                                <td>
                                    <button
                                        @click.prevent="stergeRecompensa(lr.id)"
                                        class="btn btn-sm btn-outline-dark"
                                    >
                                        Sterge
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="lista_recompense_angajat.length == 0 && lista_recompense_angajat_preluate == true">
                                <td colspan="6" class="text-center bg-warning text-bold"> Angajatul nu are recompense</td>
                            </tr>
                            </tbody>
                        </table>
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
            lista_recompense_angajat: [],
            lista_recompense_angajat_preluate: false,
            institutie_selectata: 0,
            angajat_selectat: 0,
            recompensa_selectat: 0,
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
            this.loading = true;
            await axios.get(`/api/users/institutii/acces/${this.user.id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.acces_user_institutii = response.data;
                this.loading = false;
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
            this.loading = true;
            await axios.get(`/api/recompense/preluare`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.lista_recompense = response.data;
                this.loading = false;
            });

            await axios.get(`/api/recompense/preluare/${this.angajat_selectat}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.lista_recompense_angajat = response.data.data;
                this.lista_recompense_angajat_preluate = true;
            });
        },
        async salvareRecompensaNoua(){
            this.loading = true;
            await axios.post(`/api/recompense/adaugare`, {
                id_angajat: this.angajat_selectat,
                id_recompensa: this.recompensa_selectat
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(async (response) =>{
                if(response.data.return_message == 1000){
                    Vue.$toast.open({
                        message: 'Recompensa a fost adaugata!',
                        type: 'success',
                        // all of other options may go here
                    });
                    await this.preluareRecompense();
                    this.loading = false;
                }
            })
        },
        async stergeRecompensa(id){
            await axios.post(`/api/recompense/stergere`, {
                id_recompensa: id
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(async (response) =>{
                if(response.data.return_message == 1000){
                    Vue.$toast.open({
                        message: 'Recompensa a fost stearsa!',
                        type: 'error',
                        // all of other options may go here
                    });
                    await this.preluareRecompense();
                }
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

.recompensa-activa{
    padding: 8px;
    border-radius: 3px;
    background-color: #2ecc71;
    font-weight: bold;
    color: #fff;
}

.recompensa-inactiva{
    padding: 8px;
    border-radius: 3px;
    background-color: #e74c3c;
    font-weight: bold;
    color: #fff;
}
</style>
