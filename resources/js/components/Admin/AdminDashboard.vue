<template>
    <div class="container-fluid" v-if="adminData.isAdmin === 'true'">
        <top-nav></top-nav>
        <div class="row">
            <div class="container-fluid mt-4 p-3">
                <div class="row">
                    <div class="col-12 bg-success text-white p-3 mb-2">
                        Bine ai venit, {{ adminData.user.name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Acasa</a>
                            <a class="nav-link" id="v-pills-utilizatori-tab" data-toggle="pill" href="#v-pills-utilizatori" role="tab" aria-controls="v-pills-utilizatori" aria-selected="false">Utilizatori</a>
                            <a class="nav-link" id="v-pills-regiuni-tab" data-toggle="pill" href="#v-pills-regiuni" role="tab" aria-controls="v-pills-regiuni" aria-selected="false">Regiuni</a>
                            <a class="nav-link" id="v-pills-judete-tab" data-toggle="pill" href="#v-pills-judete" role="tab" aria-controls="v-pills-judete" aria-selected="false">Judete</a>
                            <a class="nav-link" id="v-pills-localitati-tab" data-toggle="pill" href="#v-pills-localitati" role="tab" aria-controls="v-pills-localitati" aria-selected="false">Localitati</a>
                            <a class="nav-link" id="v-pills-ordonatori-tab" data-toggle="pill" href="#v-pills-ordonatori" role="tab" aria-controls="v-pills-ordonatori" aria-selected="false">Ordonatori</a>
                            <a class="nav-link" id="v-pills-institutii-tab" data-toggle="pill" href="#v-pills-institutii" role="tab" aria-controls="v-pills-institutii" aria-selected="false">Institutii</a>
                            <a class="nav-link" id="v-pills-angajati-tab" data-toggle="pill" href="#v-pills-angajati" role="tab" aria-controls="v-pills-angajati" aria-selected="false">Angajati</a>
                            <a class="nav-link" id="v-pills-functii-tab" data-toggle="pill" href="#v-pills-functii" role="tab" aria-controls="v-pills-functii" aria-selected="false">Functii</a>
                            <a class="nav-link" id="v-pills-salarii-tab" data-toggle="pill" href="#v-pills-salarii" role="tab" aria-controls="v-pills-salarii" aria-selected="false">Salarii</a>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                Acasa
                            </div>
                            <div class="tab-pane fade" id="v-pills-utilizatori" role="tabpanel" aria-labelledby="v-pills-utilizatori-tab">
                                Lista Utilizatori
                            </div>
                            <div class="tab-pane fade" id="v-pills-regiuni" role="tabpanel" aria-labelledby="v-pills-regiuni-tab">
                                Lista Regiuni
                            </div>
                            <div class="tab-pane fade" id="v-pills-judete" role="tabpanel" aria-labelledby="v-pills-judete-tab">
                                Lista Judete
                            </div>
                            <div class="tab-pane fade" id="v-pills-localitati" role="tabpanel" aria-labelledby="v-pills-localitati-tab">
                                Lista Localitati
                            </div>
                            <div class="tab-pane fade" id="v-pills-ordonatori" role="tabpanel" aria-labelledby="v-pills-ordonatori-tab">
                                Ordonatori de credite
                            </div>
                            <div class="tab-pane fade" id="v-pills-institutii" role="tabpanel" aria-labelledby="v-pills-institutii-tab">
                                Lista Institutii Bugetare
                            </div>
                            <div class="tab-pane fade" id="v-pills-angajati" role="tabpanel" aria-labelledby="v-pills-angajati-tab">
                                Lista Angajati
                            </div>
                            <div class="tab-pane fade" id="v-pills-functii" role="tabpanel" aria-labelledby="v-pills-functii-tab">
                                Lista Functii
                            </div>
                            <div class="tab-pane fade" id="v-pills-salarii" role="tabpanel" aria-labelledby="v-pills-salarii-tab">
                                Date salarizare
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" v-else>
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-12 bg-warning p-4">
                        Ne pare rau! Nu aveti acces la panoul de administrare. Puteti solicita acces <a href="#">aici</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import {getUser} from "../../functions/auth/authFunctions";

export default {
    data(){
        return{
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email,
                isAdmin: localStorage.getItem('isAdmin') || false,
                user: getUser()
            }
        }
    },
    components:{
        TopNav
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
