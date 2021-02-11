<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-12 bg-success">
                        Bun venit Admin!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";

export default {
    data(){
        return{
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
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
