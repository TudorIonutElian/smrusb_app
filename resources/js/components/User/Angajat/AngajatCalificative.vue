<template>
    <div className="container-fluid">
        <top-nav></top-nav>
        <div className="row">
            <div className="container mt-4 container-angajati">
                <div class="row mt-4">
                    <div class="col-12">
                        <div
                            class="col-12 p-2 col-table"
                        >
                            <table class="table">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th scope="col">#</th>
                                    <th scope="col">Institutie</th>
                                    <th scope="col">De la</th>
                                    <th scope="col">Pana la</th>
                                    <th scope="col">Calificativ Initial</th>
                                    <th scope="col">Contestatie</th>
                                    <th scope="col">Calificativ Final</th>
                                    <th scope="col">Stare Calificativ</th>
                                    <th scope="col">Contestatie</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                    v-if="angajat.calificative != null"
                                    v-for="(ac, index) in angajat.calificative"
                                >
                                    <td scope="col">{{ index + 1 }}</td>
                                    <td scope="col">{{ ac.ca_institutie }}</td>
                                    <td scope="col">{{ ac.ca_data_inceput }}</td>
                                    <td scope="col">{{ ac.ca_data_sfarsit }}</td>
                                    <td scope="col">{{ ac.ca_calificativ_initial }}</td>
                                    <td scope="col">
                                        <span v-if="ac.ca_are_contestatie == 0">Nu</span>
                                        <span v-if="ac.ca_are_contestatie == 1">Da</span>
                                    </td>
                                    <td scope="col">{{ ac.ca_calificativ_final }}</td>
                                    <td scope="col">{{ ac.ca_calificativ_final }}</td>
                                    <td scope="col">
                                        <button
                                            class="btn btn-sm btn-danger"
                                            :disabled="ac.ca_poate_fi_contestat == false"
                                        >Contesta
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="angajat.calificative == null">
                                    <td colspan="8" class="bg-no-evaluari text-center">Angajatul nu are evaluari operate.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="loading === true">
                    <div class="col-12">
                        <loading-component></loading-component>
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
    data() {
        return {
            user: JSON.parse(localStorage.getItem('user')),
            loading: false,
            angajat:{
                calificative: null
            }
        }
    },
    created(){
        this.preluareCalificative();
    },
    components: {
        LoadingComponent,
        TopNav,
    },
    methods: {
        async preluareCalificative(){
            this.loading = true;
            await axios.get(`/api/calificative/preluare/${this.user.user_angajat_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response =>{
                this.angajat.calificative = response.data.data;
                this.loading = false;
            });
        }
    }
}
</script>

<style scoped>
</style>
