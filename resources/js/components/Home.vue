<template>
    <div class="container-fluid">
        <top-nav></top-nav>
    </div>
</template>

<script>
    import TopNav from './Menus/TopNav.vue'
    export default {
        data(){
            return{
                isLoggedIn: this.$store.getters.isLoggedIn
            }
        },
        components:{
            TopNav
        }
    }
</script>
