<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-if="!loading">
            <div class="col-12 mt-5">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Minister</th>
                        <th scope="col">Institutie</th>
                        <th scope="col">Numar posturi aprobate</th>
                        <th scope="col">Numar posturi ocupate</th>
                        <th scope="col">Numar posturi vacante</th>
                        <th scope="col">Actualizeaza</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(i, index) in institutii" :key="i.institutie_id">
                            <th scope="row">{{ index + 1}}</th>
                            <td>{{ i.institutie_minister }}</td>
                            <td>{{ i.institutie_denumire }}</td>
                            <td>{{ i.institutie_posturi_aprobate }}</td>
                            <td>
                                <span v-if="i.institutie_posturi_ocupate > 0" class="posturi_ocupate">{{ i.institutie_posturi_ocupate }}</span>
                                <span v-if="i.institutie_posturi_ocupate == 0">{{ i.institutie_posturi_ocupate }}</span>
                            </td>
                            <td>{{ i.institutie_posturi_vacante }}</td>
                            <td>
                                <a
                                    :href="'/admin/stat/modificare/' + i.institutie_id"
                                    class="btn btn-sm btn-outline-secondary"
                                >Modifica posturi</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <loading-component v-if="loading"></loading-component>
    </div>
</template>

<script>
import TopNav from '../../Menus/TopNav'
import LoadingComponent from '../../HelperComponents/LoadingComponent.vue'

export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            user_id: JSON.parse(localStorage.getItem('user')).id,
            institutii: [],
            institutie_id: null,
            loading: false,
            institutia_are_stat_aprobat: false,
            stat_organizare_nou:{
                so_numar_posturi_aprobate: null
            },
            operatiune_finalizata: false
        }
    },
    components:{
        TopNav,
        LoadingComponent
    },
    created(){
        this.preluareInstitutiiAdmin();
    },
    methods:{
        async preluareInstitutiiAdmin(){
            this.operatiune_finalizata = false;
            this.loading = true
            await axios.get('/api/admin/institutii/posturi', {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                this.institutii = response.data.data;
                this.loading = false;
            })
        },
    }
}
</script>

<style scoped>

.row-bordered-red{
    border: 1px solid;
    border-color: #e55039;
    border-radius: 5px;
    color: #fff;
    background-color: #ED4C67;
}
.row-bordered-red span a{
    display: inline-block;
    background-color: #fff;
    color: #ED4C67;
    padding: 5px;
    border-radius: 3px;
    text-decoration: none;
    width: 50px;
}
.posturi_ocupate{
    color: #2ecc71;
    font-weight: bolder;
}
</style>
