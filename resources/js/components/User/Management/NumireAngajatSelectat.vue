<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="loading === false">
            <div class="container mt-4 container-angajati">
                <!-- row profil utilizator -->
                <div class="row mt-2">
                    <div class="col-3 col-profile">
                        <div class="row-profile">
                            <div class="row-profile-template-full p-2">Date Angajat</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Nume</div>
                            <div class="row-profile-info"> {{ angajat_data.angajat_nume }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Prenume</div>
                            <div class="row-profile-info">{{ angajat_data.angajat_prenume }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Data nasterii</div>
                            <div class="row-profile-info">{{ angajat_data.angajat_data_nasterii }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Varsta</div>
                            <div class="row-profile-info">{{ angajat_data.angajat_varsta }} ani</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Institutie</div>
                            <div class="row-profile-info">{{ angajat_data.angajat_institutie }}</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Data Aplicare</div>
                            <div class="row-profile-info row-bold-red">{{ angajat_data.angajat_last_date }}</div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-info p-2 text-center">
                                    Numire angajat
                                </div>
                                <div class="col-12 p-2">
                                    <form>
                                        <div class="mb-3">
                                            <label for="numar_act_mutare" class="form-label">Numarul actului administrativ: </label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="numar_act_mutare"
                                                v-model="numire.numar_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_emitere_act" class="form-label">Data emitere act administrativ: </label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="data_emitere_act"
                                                v-model="numire.data_emitere_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_aplicare_act" class="form-label">Data aplicare act administrativ: </label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="data_aplicare_act"
                                                v-model="numire.data_aplicare_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mutare_angajat_institutie" class="form-label">Selectati institutia: </label>
                                            <select
                                                class="form-control form-select"
                                                id="mutare_angajat_institutie"
                                                v-model="selectare_stat"
                                                @change="preluarePosturiVacante"
                                            >
                                                <option
                                                    :value="lista_institutii_acces.id"
                                                >{{ lista_institutii_acces.institutie_denumire }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" v-if="pozitii !== null && pozitii.length > 0">
                                            <label for="mutare_angajat_institutie" class="form-label">Selectati postul vacant: </label>
                                            <select
                                                class="form-control form-select"
                                                id="mutare_angajat_post"
                                                v-model="numire.pozitie_stat"
                                            >
                                                <option
                                                    v-for="p in pozitii"
                                                    :value="p.ps_pozitie"
                                                >{{ validarePozitie(p.ps_pozitie)}}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" v-if="pozitii !== null && pozitii === 0">
                                            <div id="mutare_angajat_institutie_pozitii_0">Nu exista posturi aprobate sau nu sunt posturi vacante!</div>
                                        </div>
                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary btn-block"
                                            @click.prevent="numireAngajat"
                                            :disabled="pozitii === null || pozitii === 0"
                                        >Numeste Angajat</button>
                                    </form>
                                    <notifications group="numire" position="bottom right"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="loading === true">
            <loading-component></loading-component>
        </div>
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
            lista_institutii_acces: [],
            numire:{
                numar_act_administrativ: "",
                data_emitere_act_administrativ: "",
                data_aplicare_act_administrativ: "",
                institutie_id: 0,
                pozitie_stat: 0
            },
            angajat: this.$route.params.id,
            angajat_data: {},
            selectare_stat: 0,
            pozitii: null,
            // variabile de ajutor
            loading: false

        }
    },
    created(){
        this.preluareDateAngajatNumire();
    },
    components:{
        TopNav,
        LoadingComponent
    },
    methods:{
        async preluareDateAngajatNumire(){
            this.loading = true;
            await axios.get(`/api/angajati/numire/${this.angajat}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(
                response=>{
                    this.angajat_data = response.data.data
                    this.loading = false;
                    this.preluareInstitutii();
                }
            )
        },
        async preluareInstitutii(){
            await axios.get(`/api/angajati/numire/${this.angajat_data.angajat_institutie_id}/institutie`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.lista_institutii_acces = response.data;
                    this.loading = false;
                }
            )
        },
        async preluarePosturiVacante(){
            this.loading = true;
            const cod = this.lista_institutii_acces.id;
            await axios.get(`/api/pozitii/${cod}/vacante`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    if(response.data.length > 0){
                        this.pozitii = response.data
                    }else{
                        this.pozitii = 0
                    }
                    this.loading = false;
                }
            )
        },
        async numireAngajat(){
            // TODO - validare date trimise
            await axios.post(`/api/angajati/numire/${this.angajat}`, {
                date_numire: {
                    numire_stat: this.selectare_stat,
                    numire_pozitie: this.numire.pozitie_stat,
                    numire_act: this.numire.numar_act_administrativ,
                    numire_act_emitere: this.numire.data_emitere_act_administrativ,
                    numire_act_aplicare: this.numire.data_aplicare_act_administrativ

                }
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                    this.$notify({
                        group: 'nmire',
                        title: 'Succes',
                        text: 'Persoana a fost numita la pozitia selectata!',
                        type: 'success'
                    });
                    router.push({name: 'user-dashboard'});
                }
            )
        },
        validarePozitie(pozitie){
            if(pozitie < 10){
                return `000${pozitie}`;
            }else if(pozitie > 10 & pozitie < 100){
                return `00${pozitie}`;
            }else if(pozitie > 100 & pozitie < 1000){
                return `0${pozitie}`
            }
        }
    }
}
</script>

<style scoped>
.row-profile{
    display: flex;
    flex-direction: row;
    justify-content: space-around;

}
.row-profile-template-full{
    width: 100%;
    text-align: center;
    padding: 5px;
    font-weight: bold;
    color: #04ccf6;
}
.row-profile-template{
    width: 50%;
    text-align: right;
    padding: 5px;
    font-weight: bold;
}
.row-profile-info{
    width: 50%;
    text-align: left;
    padding: 5px;
}
.col-info{
    padding: 10px;
    color: #04ccf6;
    font-weight: bold;
}
.col-table table.table{
    max-width: 100%;
    box-sizing: border-box;
}
#mutare_angajat_institutie_pozitii_0{
    font-weight: bold;
    color: #d63031;
}
.row-bold-red{
    color: #d63031;
    font-weight: bolder;
}
</style>
