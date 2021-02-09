<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TopNav from './Menus/TopNav.vue'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            TopNav
        }
    }
</script>
