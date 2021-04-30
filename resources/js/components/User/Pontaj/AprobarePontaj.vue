<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container-fluid mt-4 container-angajati">
                <div class="row my-2">
                    <div class="col-12 my-3">
                        <div class="input-group flex-nowrap">
                            <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                            <select
                                class="form-control form-select mr-1"
                                id="angajat_judet_domiciliu"
                                v-model="id_institutie_pontaj"
                            >
                                <option v-for="(i, index) in institutii" :value="i.institutie_id">{{ i.institutie_denumire}}</option>
                            </select>
                            <button class="btn btn-outline-secondary" @click.prevent="preluarePontaje">Vezi Pontaje</button>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-12" v-if="loading === false">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institutie</th>
                                <th scope="col">Pozitie</th>
                                <th scope="col">Angajat</th>
                                <th scope="col">De la</th>
                                <th scope="col">Pana la </th>
                                <th scope="col">Numar ore</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aprobare</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="lista_pontaj !== 0 || lista_pontaj.length > 0 " v-for="(l, index) in lista_pontaj">
                                <th scope="row">{{ index + 1}}</th>
                                <td>{{ l.pontaj_institutie}}</td>
                                <td>{{ pozitieNumarValidare(l.pontaj_pozitie) }}</td>
                                <td>{{ l.pontaj_angajat }}</td>
                                <td>{{ l.pontaj_dela }}</td>
                                <td>{{ l.pontaj_panala }}</td>
                                <td>{{ l.pontaj_ore }}</td>
                                <td>
                                    <span class="pontaj_aprobat" v-if="l.pontaj_status === 1"> Aprobat</span>
                                    <span class="pontaj_neaprobat" v-if="l.pontaj_status === 0"> Neaprobat</span>
                                </td>
                                <td>
                                    <span>
                                        <button
                                            class="btn btn-success btn-sm"
                                            @click.prevent="aprobarePontaj(l.pontaj_id)"
                                        >Aprobare</button>
                                    </span>
                                </td>
                            </tr>
                            <tr v-if="lista_pontaj === null || lista_pontaj.length === 0 ">
                                <td
                                    colspan="9"
                                    class="text-center no_pontaje p-2"
                                >Nu exista pontaje neaprobate pentru aceasta institutie</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <loading-component v-if="loading === true"></loading-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
import LoadingComponent from "../../HelperComponents/LoadingComponent";

export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            user_id: JSON.parse(localStorage.getItem('user')).id,
            institutii: [],
            id_institutie_pontaj: 0,
            lista_pontaj: 0,
            loading: false
        }
    },
    components:{
        LoadingComponent,
        TopNav
    },
    created() {
        this.preluareInstitutii()
    },
    methods:{
        pozitieNumarValidare(pozitie){
            if(pozitie < 10){
                return `000${pozitie}`;
            }else if(pozitie > 10 & pozitie < 100){
                return `00${pozitie}`;
            }else if(pozitie > 100 & pozitie < 1000){
                return `0${pozitie}`
            }
        },
        async preluareInstitutii(){
            this.loading = true;
            await axios.get(`/api/users/institutii/stat/${this.user_id}`).then(response => {
                this.institutii = response.data.data;
                this.loading = false;
            })
        },
        async preluarePontaje(){
            this.loading = true;
            this.lista_pontaj = 0;
            await axios.get(`/api/pontaj/preluare/institutie/${this.id_institutie_pontaj}/neaprobat`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            })
                .then(response =>{
                    this.lista_pontaj = response.data.data;
                    console.log(response.data)
                    this.loading = false;
                })
                .catch(error => console.log(error));
        },
        async aprobarePontaj(id){
            this.loading = true;
            await axios.post(`/api/pontaj/aprobare`, {
                    pontaj: id
            }, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.preluarePontaje();
                this.loading = false;
                Vue.$toast.open({
                    message: 'Pontaj aprobat!',
                    type: 'success',
                    // all of other options may go here
                });
            }).catch(error => console.log(error));
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
span.pontaj_aprobat,
span.pontaj_neaprobat{
    padding: 5px;
    font-weight: bolder;
    border-radius: 3px;
    color: #fff;
    width: 150px;
}
span.pontaj_aprobat{
    background-color: #55efc4;
}
span.pontaj_neaprobat{
    background-color: #d63031;
}
.no_pontaje{
    color: #d63031;
    font-weight: bold;
}
</style>
