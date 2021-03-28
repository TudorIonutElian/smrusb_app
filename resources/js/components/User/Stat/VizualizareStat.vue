<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row mt-4">
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 my-3">
                            <div class="input-group flex-nowrap">
                                <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                                <select class="form-control form-select mr-1" v-model="id_institutie">
                                    <option v-for="institutie in institutii" :value="institutie.institutie_id">{{ institutie.institutie_denumire }}</option>
                                </select>
                                <button
                                    class="btn btn-success"
                                    @click.prevent="preluareStat()"
                                >Vizualizare</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-2" v-if="date_preluate_valid">
                            <div class="col-row-info">Statul de organizare al : <span>{{ date_preluate.institutie}}</span> </div>
                            <div class="col-row-info">Numar posturi aprobate : <span>{{ date_preluate.stat.so_numar_posturi_aprobate }}</span></div>
                        </div>
                        <div class="col-12 mt-3">
                            <table class="table text-center">
                                <thead>
                                <tr class="tr-flex-row">
                                    <th scope="col">Pozitie</th>
                                    <th scope="col" class="td-cuprins">Denumire Cuprins</th>
                                    <th scope="col">Denumire Functie</th>
                                    <th scope="col">Coeficient Functie</th>
                                    <th scope="col">Suma Functie</th>
                                    <th scope="col">Gradul persoanei</th>
                                    <th scope="col">Nume si prenume</th>
                                    <th scope="col">Data numirii</th>
                                    <th scope="col">Numar act</th>
                                    <th scope="col">Data emitere act</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">0001</th>
                                        <td class="td-cuprins">I - Conducere</td>
                                        <td >Director general</td>
                                        <td>2.88</td>
                                        <td>8.000</td>
                                        <td>-</td>
                                        <td><a href="/">Popescu Aurelian</a></td>
                                        <td>01.07.2017</td>
                                        <td>123456</td>
                                        <td>03.06.2017</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
            institutii: [],
            user:{
                id: JSON.parse(localStorage.getItem('user')).id,
                token: localStorage.getItem('token')
            },
            id_institutie: null,
            id_stat: null,
            date_preluate:{
                institutie: "",
                stat: {},
                pozitii: []
            }
        }
    },
    computed:{
      date_preluate_valid : function (){
          return Object.keys(this.date_preluate).length > 0 && this.date_preluate.institutie !== ""
      }
    },
    components:{
        TopNav
    },
    created() {
        this.preluareInstitutii()
    },
    methods:{
        // preluare institutii la care utulizatorul are acces
        async preluareInstitutii(){
            await axios.get(`/api/users/institutii/stat/${this.user.id}`).then(response => {
                this.institutii = response.data.data;
            })
        },
        // preluare stat de organizare
        async preluareStat(){
            await axios.get(`/api/users/institutii/${this.id_institutie}/stat/`).then(response=>{
                this.date_preluate.institutie = response.data.institutie
                this.date_preluate.stat = response.data.stat
            });
            // preluare pozitii
            await axios.get(`/api/stat/${this.date_preluate.stat.id}/pozitii`).then(response=>{
                this.date_preluate.pozitii = response.data;
            })
        }
    }
}
</script>

<style scoped>
.td-cuprins{
    text-align: right;
}
tr.post-liber{
    background-color: #f6e58d;
}
.col-row-info {
    font-weight: bolder;
}
.col-row-info span{
    font-weight: normal;
}
</style>
