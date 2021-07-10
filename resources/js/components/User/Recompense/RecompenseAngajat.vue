<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 my-4">
                        <span class="bg-primary text-white p-3">Lista Recompense {{user.user_first_name}} {{user.user_last_name}}</span>
                    </div>
                </div>
                <div class="row" v-if="loading == false">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Denumire recompensa</th>
                                <th scope="col">Data acordarii</th>
                                <th scope="col">Data exprirarii</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(r, index) in lista_recompense">
                                    <th scope="row">{{ index + 1}}</th>
                                    <td>{{ r.denumire }}</td>
                                    <td>{{ r.data_acordarii }}</td>
                                    <td>{{ r.data_expirarii }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" v-if="loading == true">
                    <loading-component></loading-component>
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
            user: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            lista_recompense: null,
            loading: true
        }
    },
    components:{
        LoadingComponent,
        TopNav,
    },
    created(){
        this.preluareRecompense();
    },
    methods:{
        async preluareRecompense(){
            await axios.get(`/api/recompense/preluare/${this.user.user_angajat_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.lista_recompense = response.data.data;
                this.loading = false;
            })
        }
    }
}
</script>

<style scoped>
</style>
