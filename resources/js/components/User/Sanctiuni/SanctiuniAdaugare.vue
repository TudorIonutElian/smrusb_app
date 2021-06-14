<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="loading == false">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 mt-3 mb-4">
                        <span class="recompense-badge">Adaugare sanctiuni angajati</span>
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
                            @change="preluareSanctiuni"
                        >
                            <option v-for="a in lista_angajati" :value="a.id">{{a.angajat_nume}} {{ a.angajat_prenume }}</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <button
                            class="btn btn-outline-success btn-block"
                            :disabled="institutie_selectata == 0"
                            @click.prevent="salvareRecompensaNoua"
                        >Adaugare Sanctiune</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <select
                            class="form-select form-control"
                            aria-label="Default select example"
                            :disabled="angajat_selectat == 0"
                            v-model="sanctiune_selectat"
                        >
                            <option v-for="s in lista_sanctiuni" :value="s.id">{{ s.ds_denumire }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3" v-if="lista_sanctiuni_angajat.length > 0">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Recompensa</th>
                                <th scope="col">Data acordarii</th>
                                <th scope="col">Data expirarii</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(lr, index) in lista_sanctiuni_angajat">
                                <th scope="row">{{ index + 1}}</th>
                                <td>{{ lr.denumire }}</td>
                                <td>{{ lr.data_acordarii }}</td>
                                <td>{{ lr.data_expirarii }}</td>
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
            lista_sanctiuni: [],
            lista_sanctiuni_angajat: [],
            institutie_selectata: 0,
            angajat_selectat: 0,
            sanctiune_selectat: 0,
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
        async preluareSanctiuni(){
            await axios.get('/api/sanctiuni/preluare', {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(async (response) =>{
                this.lista_sanctiuni = response.data;
                await axios.get(`/api/sanctiuni/preluare/${this.angajat_selectat}`, {
                    headers:{
                        ContentType: 'application/json',
                        Authorization : 'Bearer ' + this.token
                    }
                }).then(response =>{
                    this.lista_sanctiuni_angajat = response.data.data
                });
            });


        },
        // async salvareRecompensaNoua(){
        //     await axios.post(`/api/sanctiuni/adaugare`, {
        //         id_angajat: this.angajat_selectat,
        //         id_recompensa: this.recompensa_selectat
        //     }, {
        //         headers:{
        //             ContentType: 'application/json',
        //             Authorization : 'Bearer ' + this.token
        //         }
        //     }).then((response) =>{
        //         if(response.data.return_message == 1000){
        //             Vue.$toast.open({
        //                 message: 'Sanctiunea a fost adaugata!',
        //                 type: 'success',
        //                 // all of other options may go here
        //             });
        //             this.$router.go();
        //         }
        //     })
        // }

    },

}
</script>

<style scoped>
.recompense-badge{
    background-color: #e74c3c;
    padding: 10px;
    border-radius: 4px;
    font-weight: bold;
    color: #fff;
}
button.btn-outline-success{
    background-color: #e74c3c!important;
    font-weight: bold;
    color: #fff;
    border: none;
    outline: none;
}
</style>
