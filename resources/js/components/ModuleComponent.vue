<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-3">Coloana 1</div>
                    <div class="col-3">Coloana 2</div>
                    <div class="col-3">Coloana 2</div>
                    <div class="col-3">Coloana 2</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "./Menus/TopNav";

export default {
    data(){
        return{

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
