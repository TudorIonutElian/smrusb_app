<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container-fluid mt-4 container-angajati">
                <search-component
                    v-on:searched="searchEmitted"
                    v-on:resetedClick="resetEmitted"
                ></search-component>
                <angajat-dashboard v-if="user.user_type === 3"></angajat-dashboard>
                <specialist-dashboard
                    v-if="user.user_type === 0"
                    :optiune-filtrare="optiune_filtrare"
                ></specialist-dashboard>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import AngajatDashboard from "../Dashboard/AngajatDashboard";
import SpecialistDashboard from "../Dashboard/SpecialistDashboard";
import SearchComponent from "../HelperComponents/SearchComponent";

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
            optiune_filtrare: ""
        }
    },
    components:{
        TopNav,
        AngajatDashboard,
        SpecialistDashboard,
        SearchComponent
    },
    methods:{
        searchEmitted(value){
            this.optiune_filtrare = value;
        },
        resetEmitted(value){
            this.optiune_filtrare = value;
            this.$router.go();

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
.contract_incetat{
    font-weight: bolder;
    color: #e74c3c;
}
</style>
