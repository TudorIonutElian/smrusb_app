<template>
    <div>
        <top-nav
            :utilizatoriInactivi="generalData.utilizatoriInactivi"
            :este-administrator="adminData.isAdmin"
        ></top-nav>
        <div class="container-fluid" v-if="adminData.isAdmin !== 'false'">
            <div class="row">
                <div class="container-fluid mt-4 p-3">
                    <div class="row">
                        <div class="col-12 bg-success text-white p-3 mb-2">
                            Bine ai venit, {{ adminData.email.user_email}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" v-if="adminData.isAdmin === 'false'">
            <div class="row">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12 bg-warning p-4">
                            Ne pare rau! Nu aveti acces la panoul de administrare.
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
            },
            adminData:{
                email: getUserEmail(),
                isAdmin: localStorage.getItem('isAdmin') || 'false',
                user: getUser(),
                token: ""
            }
        }
    },
    created() {
        this.token = localStorage.getItem('token');
    },
    components:{
        JudetePannel,
        RegiuniPannel,
        TopNav,
        UtilizatoriPannel
    },
    methods:{

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
