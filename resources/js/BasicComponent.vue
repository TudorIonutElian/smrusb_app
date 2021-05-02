<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container-fluid mt-4 container-angajati">

            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
        }
    },
    components:{
        TopNav,
    },
    methods:{

    }
}
</script>

<style scoped>
</style>
