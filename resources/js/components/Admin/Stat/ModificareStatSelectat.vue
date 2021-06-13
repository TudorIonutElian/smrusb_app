<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <loading-component v-if="loading == true"></loading-component>
            <div class="container mt-5 container-angajati" v-if="loading == false">
                <div class="row">
                    <div class="col-12 p-2 my-2 text-center">
                        <span class="col-12-badge">
                            {{ dateInstitutie.institutie_denumire }}
                        </span>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-right">
                        Numar posturi aprobate
                    </div>
                    <div class="col-6 text-left">
                        {{ dateInstitutie.institutie_posturi_aprobate }}
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-right">
                        Numar posturi ocupate
                    </div>
                    <div class="col-6 text-left">
                        {{ dateInstitutie.institutie_posturi_ocupate }}
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-right">
                        Numar posturi vacante
                    </div>
                    <div class="col-6 text-left">
                        {{ dateInstitutie.institutie_posturi_vacante }}
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-right">
                        Actualizare posturi
                    </div>
                    <div class="col-3 text-center">
                        <input
                            type="number"
                            placeholder="Numar posturi aprobate"
                            v-model="numarPosturiNoi"
                            :min="dateInstitutie.institutie_posturi_ocupate"
                            @blur="valideazaDatePosturi"
                            class="form-control">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-12">
                        <button
                            class="btn btn-block btn-outline-actualizare"
                            @click.prevent="actualizarePosturi"
                            :disabled="buttondisabled == true"
                        >Actualizare numar posturi
                        </button>
                    </div>
                </div>
            </div>
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
            loading: false,
            buttondisabled: true,
            user: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            id_institutie: parseInt(this.$route.params.id),
            dateInstitutie: null,
            numarPosturiNoi: 0
        }
    },
    created(){
        this.preluarePosturi();
    },
    components:{
        LoadingComponent,
        TopNav,
    },
    methods:{
        async preluarePosturi(){
            this.loading = true;
            await axios.get(`/api/admin/institutii/posturi/${this.id_institutie}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.dateInstitutie = response.data;
                this.loading = false;
            });
        },
        async actualizarePosturi(){
            this.loading = true;
            await axios.post('/api/admin/institutii/posturi/actualizare', {
                id_institutie: this.id_institutie,
                numar_posturi: parseInt(this.numarPosturiNoi)
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.loading = false;
                router.push({name: 'modificare-stat'});
            });
        },
        valideazaDatePosturi(){
            if(this.numarPosturiNoi == ""){
                Vue.$toast.open({
                    message: 'Introduceti date numerice!',
                    type: 'warning',
                    // all of other options may go here
                });
            }
            else if(this.numarPosturiNoi < this.dateInstitutie.institutie_posturi_ocupate){
                Vue.$toast.open({
                    message: 'Numarul de posturi trebuie sa fie mai >= decat posturile ocupate!',
                    type: 'error',
                    // all of other options may go here
                });
            }else{
                Vue.$toast.open({
                    message: 'Numarul de posturi este valid!',
                    type: 'success',
                    // all of other options may go here
                });
                this.buttondisabled = false;
            }
        }
    }
}
</script>

<style scoped>
.col-12-badge{
    padding: 12px;
    border-radius: 4px;
    background-color: #575fcf;
    font-weight: bolder;
    color: #fff;
}
button.btn-outline-actualizare{
    border: 1px solid #575fcf;
    color: #575fcf;
}
button.btn-outline-actualizare:hover{
    background-color: #575fcf;
    color: #fff;
}
div.col-6.text-right {
    font-weight: bolder;
}
</style>
