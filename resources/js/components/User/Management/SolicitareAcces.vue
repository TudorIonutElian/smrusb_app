<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row mt-4">
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="col-12 bg-success p-2 text-white">Solicitare Acces la Institutii</div>
                        <div class="col-12 my-3">
                            <div class="input-group flex-nowrap">
                                <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                                <select class="form-control form-select mr-1" id="angajat_judet_domiciliu" v-model="institutie_acces_code">
                                    <option v-for="institutie in institutii" :value="institutie.institutie_cod_acces">{{ institutie.institutie_denumire}}</option>
                                </select>
                                <button class="btn btn-success" @click.prevent="solicitaAcces">Solicitare Acces</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-white p-2"><span class="bg-secondary p-2">Aveti acces la: </span></div>
                        <div class="col-12 mt-3">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Denumire Institutie</th>
                                    <th scope="col">Acces de la:</th>
                                    <th scope="col">Acces pana la:</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(acces, index) in user_acces">
                                        <th scope="row">{{ index + 1}}</th>
                                        <td>{{ acces.ua_denumire }}</td>
                                        <td>{{ acces.ua_start_date}}</td>
                                        <td>{{ acces.ua_end_date ? acces.ua_end_date : 'Prezent' }}</td>
                                        <td v-show="acces.ua_status === 1"><span class="acces_activ">Activ</span></td>
                                        <td v-show="acces.ua_status === 0"><span class="acces_inactiv">Inactiv</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <notifications group="acces_existent" position="bottom right"/>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";

export default {
    data(){
        return{
            institutii: [],
            institutie_acces_code: null,
            user_id: JSON.parse(localStorage.getItem('user')).id,
            token: localStorage.getItem('token'),
            user_acces: null
        }
    },
    components:{
        TopNav
    },
    created(){
      this.preluareInstitutii();
      this.preluareAccesUser();
    },
    methods:{
        async preluareInstitutii(){
            await axios.get('/api/users/inregistrare/institutii').then(response =>{
                this.institutii = response.data;
            })
        },
        async preluareAccesUser(){
            await axios.get("/api/users/acces/" + this.user_id,{
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.user_acces = response.data;

            })
        },
        async solicitaAcces(){
            await axios.post("/api/users/acces/" + this.user_id,{
                user_acces_solicitat: this.institutie_acces_code
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                if(response.data.return_code === 2003){
                    this.$notify({
                        group: 'acces_existent',
                        title: 'Atentionare acces',
                        text: 'Aveti deja acces!',
                        type: 'warn'
                    });
                }else{
                    this.preluareAccesUser();
                }


            })
        }
    }
}
</script>

<style scoped>
.acces_activ{
    padding: 10px;
    border-radius: 3px;
    background-color: #2ecc71;
    color: #ffffff;
}
.acces_inactiv{
    padding: 10px;
    border-radius: 3px;
    background-color: #e74c3c;
    color: #ffffff;
}
</style>
