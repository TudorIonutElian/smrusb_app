<template>
    <div>
        <div class="container-fluid">
            <top-nav></top-nav>
            <div class="row">
                <div class="container-fluid mt-4 p-3">
                    <div class="row">
                        <div class="col-12 bg-success text-white p-3 mb-2">
                            Bine ai venit, {{ adminData.user.name}}
                        </div>
                    </div>
                    <div class="row">
                        <!-- Meniu Partea Stanga -->
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Acasa</a>
                                <a class="nav-link" id="v-pills-utilizatori-tab" data-toggle="pill" href="#v-pills-utilizatori" role="tab" aria-controls="v-pills-utilizatori" aria-selected="false">Utilizatori</a>
                                <a class="nav-link" id="v-pills-regiuni-tab" data-toggle="pill" href="#v-pills-regiuni" role="tab" aria-controls="v-pills-regiuni" aria-selected="false">Regiuni</a>
                                <a class="nav-link" id="v-pills-judete-tab" data-toggle="pill" href="#v-pills-judete" role="tab" aria-controls="v-pills-judete" aria-selected="false">Judete</a>
                                <a class="nav-link" id="v-pills-localitati-tab" data-toggle="pill" href="#v-pills-localitati" role="tab" aria-controls="v-pills-localitati" aria-selected="false">Localitati</a>
                                <a class="nav-link" id="v-pills-institutii-tab" data-toggle="pill" href="#v-pills-institutii" role="tab" aria-controls="v-pills-institutii" aria-selected="false">Institutii</a>
                                <a class="nav-link" id="v-pills-angajati-tab" data-toggle="pill" href="#v-pills-angajati" role="tab" aria-controls="v-pills-angajati" aria-selected="false">Angajati</a>
                                <a class="nav-link" id="v-pills-functii-tab" data-toggle="pill" href="#v-pills-functii" role="tab" aria-controls="v-pills-functii" aria-selected="false">Functii</a>
                                <a class="nav-link" id="v-pills-salarii-tab" data-toggle="pill" href="#v-pills-salarii" role="tab" aria-controls="v-pills-salarii" aria-selected="false">Salarii</a>
                            </div>
                        </div>
                        <!-- Meniu Partea Dreapta -->
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- Meniu Partea Dreapta - Date Generale -->
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 bg-primary p-2 text-white">Detalii generale Panou de administrare</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Meniu Partea Dreapta - Utlizatori -->
                                <div class="tab-pane fade" id="v-pills-utilizatori" role="tabpanel" aria-labelledby="v-pills-utilizatori-tab">
                                    <utilizatori-pannel
                                        :utilizatori-data="generalData.users"
                                        v-on:suspendaUtilizator="loadGeneralData"
                                        v-on:activeazaUtilizator="loadGeneralData"
                                    >
                                    </utilizatori-pannel>
                                </div>
                                <!-- Meniu Partea Dreapta - Regiuni -->
                                <div class="tab-pane fade" id="v-pills-regiuni" role="tabpanel" aria-labelledby="v-pills-regiuni-tab">
                                    <regiuni-pannel :regiuni-data="generalData.regiuni"></regiuni-pannel>
                                </div>
                                <!-- Meniu Partea Dreapta - Judete -->
                                <div class="tab-pane fade" id="v-pills-judete" role="tabpanel" aria-labelledby="v-pills-judete-tab">
                                    <judete-pannel :judete-data="generalData.judete"></judete-pannel>
                                </div>
                                <div class="tab-pane fade" id="v-pills-localitati" role="tabpanel" aria-labelledby="v-pills-localitati-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 bg-primary p-2 text-white">Lista Localitati</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-institutii" role="tabpanel" aria-labelledby="v-pills-institutii-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 bg-primary p-2 text-white">Lista Institutii Bugetare</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-angajati" role="tabpanel" aria-labelledby="v-pills-angajati-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 bg-primary p-2 text-white">Lista Angajati</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-functii" role="tabpanel" aria-labelledby="v-pills-functii-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 bg-primary p-2 text-white">Lista Functii</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" v-if="adminData.isAdmin !== null && adminData.isAdmin === false">
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
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import UtilizatoriPannel from "../Panels/UtilizatoriPannel";
import {getUser, getUserEmail} from "../../functions/auth/authFunctions";
import RegiuniPannel from "../Panels/RegiuniPannel";
import JudetePannel from "../Panels/JudetePannel";

export default {
    data(){
        return{
            generalData:{
                users: [],
                regiuni: [],
                judete: []
            },
            adminData:{
                email: getUserEmail(),
                isAdmin: localStorage.getItem('isAdmin') || false,
                user: getUser(),
                token: ""
            }
        }
    },
    created() {
        this.token = localStorage.getItem('token');
        if(this.user !== null){
            this.loadGeneralData();
        }
    },
    components:{
        JudetePannel,
        RegiuniPannel,
        TopNav,
        UtilizatoriPannel
    },
    methods:{
        async loadGeneralData(){
            await axios.get('/api/data', {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(
                response => {
                    this.generalData.users      = response.data.users;
                    this.generalData.regiuni    = response.data.regiuni;
                    this.generalData.judete    = response.data.judete;
                }
            );
        }
    }
}
</script>

<style scoped>
td.admin-class span,
td.specialist-class span,
td.angajat-class span{
    width: 100%;
}
.faraRol-class{
    padding: 5px;
    color: #869191;
    border-radius: 5px;
}


</style>
