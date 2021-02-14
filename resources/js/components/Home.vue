<template>
    <div class="container-fluid">
        <top-nav></top-nav>
    </div>
</template>

<script>
    import TopNav from './Menus/TopNav.vue'
    import router from "../router/router";
    import {checkIfIsAdmin, checkIfLoggedIn} from "../functions/auth/authFunctions";
    export default {
        data(){
            return{
                isLoggedIn: checkIfLoggedIn(),
                isAdmin: checkIfIsAdmin()
            }
        },
        created(){
            if(this.isLoggedIn === 'true'){
                if(this.isAdmin === 'true'){
                    router.push({ name: 'admin-dashboard'});
                }else{
                    router.push({ name: 'user-dashboard'});
                }
            }else{
                router.push({ name: 'login'});
            }
        },
        methods:{
        },
        components:{
            TopNav
        }
    }
</script>
