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
                                    <th scope="col">Status</th>
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
                                    <th scope="col">Vechime functie</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr class="institutie_no_stat" v-show="this.id_stat === 0">
                                        <th scope="row" colspan="12">
                                            <span>Institutia nu are un stat aprobat!</span>
                                        </th>
                                    </tr>
                                    <tr class="institutie_no_pozitii" v-if="this.date_preluate.pozitii.data.length === 0">
                                        <th scope="row" colspan="12">
                                            <span>Statul nu are pozitii create!</span>
                                        </th>
                                    </tr>
                                    <tr
                                        v-if="date_preluate.pozitii.data.length > 0"
                                        v-for="pozitie in date_preluate.pozitii.data"
                                        :class=" pozitie.pozitie_angajat === null ? 'pozitieLibera' : 'pozitieOcupata' "
                                    >
                                        <td><span>{{ pozitieStatus(pozitie)}}</span></td>
                                        <td>{{ pozitieNumarValidare(pozitie.pozitie_numar) }}</td>
                                        <td class="td-cuprins">{{ pozitie.pozitie_denumire_cuprins }}</td>
                                        <td>{{ pozitie.pozitie_functie.functie_denumire}}</td>
                                        <td>{{ pozitie.pozitie_functie.functie_coeficient}}</td>
                                        <td>{{ pozitie.pozitie_functie.functie_suma}}</td>
                                        <td>-</td>
                                        <!-- Returnare link catre pagina angajati -->
                                        <td v-if="pozitie.pozitie_angajat !== null"><a :href="'/angajat/' + pozitie.pozitie_angajat.id">{{ angajatValidare(pozitie.pozitie_angajat) }} </a></td>
                                        <td v-if="pozitie.pozitie_angajat === null"><a href="/user/dashboard">{{ angajatValidare(pozitie.pozitie_angajat) }} </a></td>
                                        <td>{{ pozitie.pozitie_data_numire}}</td>
                                        <td>{{ pozitie.pozitie_numar_act}}</td>
                                        <td>{{ pozitie.pozitie_data_act}}</td>

                                        <!-- Returnare vechime in zile -->
                                        <td v-if="pozitie.pozitie_vechime">{{ pozitie.pozitie_vechime}} zile</td>
                                        <td v-if="!pozitie.pozitie_vechime">-</td>
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
                pozitii: {
                    data: 0
                }
            }
        }
    },
    computed:{
      date_preluate_valid : function (){
          return Object.keys(this.date_preluate).length > 0 && this.date_preluate.institutie !== "" && this.date_preluate.stat !== null
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
            if(this.date_preluate.stat){
                this.id_stat = 1
                // preluare pozitii
                await axios.get(`/api/stat/${this.date_preluate.stat.id}/pozitii`).then(response=>{
                    this.date_preluate.pozitii = response.data;
                })
            }else{
                this.id_stat = 0
                this.date_preluate.pozitii.data = 0;
            }
        },
        angajatValidare(angajat){
            if (angajat !== null) {
                return `${angajat.angajat_nume} ${angajat.angajat_prenume}`
            } else {
                return ``;
            }
        },
        pozitieNumarValidare(pozitie){
            if(pozitie < 10){
                return `000${pozitie}`;
            }else if(pozitie > 10 & pozitie < 100){
                return `00${pozitie}`;
            }else if(pozitie > 100 & pozitie < 1000){
                return `0${pozitie}`
            }
        },
        pozitieStatus(pozitie){
            if(pozitie.pozitie_angajat === null){
                return 'Post Vacant';
            }else if(pozitie.pozitie_angajat !== null){
                return 'Post Ocupat';
            }
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
.institutie_no_stat{
    background-color: #ff6b6b;
    color: #fff;
}
.institutie_no_pozitii{
    background-color: #feca57;
    color: #333;
}
tr.pozitieOcupata{
    color: #1dd1a1;
    font-weight: bold;
}
tr.pozitieLibera{
    color: #ff6b6b;
    font-weight: bold;
}
</style>
