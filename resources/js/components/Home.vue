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
        async mounted() {
            await axios.get('/sanctum/csrf-cookie').then(response =>{
                console.log(response)
            })
            await axios.post('/login', {
                email: "lind.lia@example.net",
                password: "passwor"
            }).then(response => {
                console.log(response)
            })

            await axios.get('/user').then(response => {
                console.log(response)
            })
        },
        components:{
            TopNav
        }
    }
</script>
