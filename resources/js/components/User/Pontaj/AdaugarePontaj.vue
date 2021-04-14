<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 my-2 p-2 bg-success text-center text-white">
                        Adaugare Pontaj Lunar
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 mb-2 col-flex-column">
                        <label for="pontaj_data_inceput">Data inceput</label>
                        <input type="date" class="form-control" id="pontaj_data_inceput" v-model="date_pontaj.pontaj_data_inceput">
                    </div>
                    <div class="col-3 mb-2 col-flex-column">
                        <label for="pontaj_data_sfarsit">Data inceput</label>
                        <input type="date" class="form-control" id="pontaj_data_sfarsit" v-model="date_pontaj.pontaj_data_sfarsit">
                    </div>
                    <div class="col-3 mb-2 col-flex-column">
                        <label for="pontaj_numar_ore">Numar ore</label>
                        <input type="number" class="form-control" id="pontaj_numar_ore" v-model="date_pontaj.pontaj_numar_ore">
                    </div>
                    <div class="col-3 mb-2 col-flex-column">
                        <label for="pontaj_numar_ore">Adaugare pontaj</label>
                        <a href="/" class="btn btn-block btn-outline-success" @click.prevent="adaugarePontaj">Adauga Pontaj</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Data inceput</th>
                                <th scope="col">Data sfarsit</th>
                                <th scope="col">Numar ore</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detalii</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(pontaj, index) in pontaje_existente">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ pontaj.pl_start_date }}</td>
                                <td>{{ pontaj.pl_end_date }}</td>
                                <td>
                                    <span class="pontaj_normal" v-if="pontaj.pl_numar_ore > 100 && pontaj.pl_numar_ore < 165">{{ pontaj.pl_numar_ore }}</span>
                                    <span class="pontaj_scazut" v-if="pontaj.pl_numar_ore < 100 ">{{ pontaj.pl_numar_ore }}</span>
                                    <span class="pontaj_suplimentar" v-if="pontaj.pl_numar_ore > 164 && pontaj.pl_numar_ore < 200">{{ pontaj.pl_numar_ore }}</span>
                                    <span class="pontaj_verificare" v-if="pontaj.pl_numar_ore > 200">{{ pontaj.pl_numar_ore }}</span>
                                </td>
                                <td>
                                    <span class="pontaj bg-success text-white p-2" v-if="pontaj.pl_este_aprobat === 1">Aprobat</span>
                                    <span class="pontaj bg-danger text-white p-2" v-if="pontaj.pl_este_aprobat === 0">Neaprobat</span>
                                </td>
                                <td>
                                    <span class="pontaj_normal" v-if="pontaj.pl_numar_ore > 100 && pontaj.pl_numar_ore < 165">Pontaj Normal</span>
                                    <span class="pontaj_scazut" v-if="pontaj.pl_numar_ore < 100 ">Pontaj Scazut</span>
                                    <span class="pontaj_suplimentar" v-if="pontaj.pl_numar_ore > 164 && pontaj.pl_numar_ore < 200">Pontaj Suplimentar</span>
                                    <span class="pontaj_verificare" v-if="pontaj.pl_numar_ore > 200">Pontajul necesita verificare</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            date_pontaj: {
                pontaj_angajat_id: JSON.parse(localStorage.getItem('user')).user_angajat_id,
                pontaj_data_inceput: "",
                pontaj_data_sfarsit: "",
                pontaj_numar_ore: 0,
                pontaj_institutie_acces: JSON.parse(localStorage.getItem('user')).user_cod_acces,
            },
            pontaje_existente: null
        }
    },
    created(){
        this.preluarePontaje();
    },
    components:{
        TopNav
    },
    computed:{
        date_pontaj_valid: function (){
            return this.date_pontaj.pontaj_angajat_id !== null && this.date_pontaj.pontaj_data_inceput !== "" && this.date_pontaj.pontaj_data_sfarsit !== ""
        }
    },
    methods:{
        async preluarePontaje(){
            await axios.get("/api/pontaj/preluare/" + this.date_pontaj.pontaj_angajat_id, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response => {
                this.pontaje_existente = response.data;
            })
        },
        async adaugarePontaj(){
            if(this.date_pontaj_valid){
                await axios.post("/api/pontaj/creare", {
                    pontaj: this.date_pontaj
                }, {
                    headers:{
                        ContentType: 'application/json',
                        Authorization : 'Bearer ' + this.token
                    }
                }).then(response => {
                    if(response.data.code_message === 'pontaj_existent'){
                        Vue.$toast.open({
                            message: 'Exista pontaj adaugat pentru luna acesta!',
                            type: 'error',
                            // all of other options may go here
                        });
                    }
                    this.preluarePontaje();
                })
            }
        }
    }
}
</script>

<style scoped>
.btn-show{
    border: none;
}
.btn-show:hover{
    color: #ffffff;
    background-color: #38c172;
    border: none;
}
.col-flex-column{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.pontaj{
    min-width: 150px;
    border-radius: 3px;
}
.pontaj_normal{
    font-weight: bold;
    color: #2ecc71;
}
.pontaj_scazut{
    font-weight: bold;
    color: #e67e22;
}
.pontaj_suplimentar{
    font-weight: bold;
    color: #8e44ad;
}
.pontaj_verificare{
    font-weight: bold;
    color: #e74c3c;
}
</style>
