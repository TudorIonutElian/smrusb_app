<template>
    <div class="container-fluid">
        <top-nav
            :este-administrator="isAdmin">
        </top-nav>
        <div class="container" v-if="isAdmin === true">
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr class="bg-success-head-row">
                            <th scope="col">#</th>
                            <th scope="col">Utilizator</th>
                            <th scope="col">Acces Institutie</th>
                            <th scope="col">Data Solicitarii</th>
                            <th scope="col">Actiune</th>
                        </tr>
                        </thead>
                        <tbody class="angajati">
                        <tr v-for="(solicitare, index) in solicitari_acces">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ solicitare.solicitare_user }}</td>
                            <td>{{ solicitare.solicitare_institutie }}</td>
                            <td>{{ solicitare.solicitare_data }}</td>
                            <td>
                                <button class="btn btn-success-activate btn-sm" @click.prevent="aprobareAcces(solicitare.solicitare_id)">Aproba Acces
                                </button>
                            </td>
                        </tr>
                        <tr v-show="solicitari_acces.length == 0">
                            <td colspan="8" class="bg-warning text-center">Nu exista solicitari de acces</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <notifications group="aprobare" position="bottom right"/>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import AlertaAdmin from "../Alerte/AlertaAdmin";
import NoAcces from './NoAcces';
export default {
    data(){
        return{
            solicitari_acces: [],
            token: localStorage.getItem('token'),
            isAdmin: (JSON.parse(localStorage.getItem('isAdmin')))
        }
    },
    created(){
        this.preluareSolicitariAcces();
    },
    methods:{
        async preluareSolicitariAcces(){
            await axios.get('/api/admin/solicitari_acces', {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.solicitari_acces = response.data.data;
            })
        },
        async aprobareAcces(id){
            await axios.post('/api/admin/aprobare_acces', {
                solicitare_id: id
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                if(response.data.return_code === 2000){
                    this.$notify({
                        group: 'aprobare',
                        title: 'Aprobat',
                        text: 'Solicitarea a fost aprobat cu succes.',
                        type: 'success'
                    });
                    this.preluareSolicitariAcces();
                }

            })
        }
    },
    components:{
        NoAcces,
        AlertaAdmin,
        TopNav
    }
}
</script>

<style scoped>
.bg-success-head-row{
    color: #44bd32;
}
.td-inactiv{
    color: #eb4d4b;
    border-radius: 5px;
    font-weight: bold;
}
table{
    text-align: center;
}
tbody.angajati{
    text-align: center;
}
.btn-success-activate{
    background-color: #44bd32;
    color: #ffffff;
}
.btn-success-activate:hover{
    background-color: #ffffff;
    color: #44bd32;
    border: 1px solid #44bd32;
}
</style>
