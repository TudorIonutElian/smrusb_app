<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div>
            <div id="loginArea">
                <div id="loginArea_details">
                    <img src="/images/login.png" alt="">
                </div>
                <div id="loginArea_form">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Adresa de email</label>
                            <input type="email" class="form-control w-100" v-model="user.email">
                            <div>Resetarea parolei poate fi facuta accesand formularul de aici</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Parola</label>
                            <input type="password" class="form-control" v-model="user.password">
                        </div>
                        <button @click.prevent="login" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import TopNav from '../Menus/TopNav';
import router from "../../router/router";


export default {
    data(){
        return{
            user:{
                email: null,
                password: null,
                isLoggedIn: false,
                isAdmin: false,
                userData: {}
            },
            device: 'device-browser',
            token: "",
            loginError: null
        }
    },
    async created() {
        await this.checkUserLoggedIn();
    },
    methods:{
        async checkUserLoggedIn(){
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            if(isLoggedIn === 'true'){
                const user = JSON.parse(localStorage.getItem('user'));
                this.user.email = user.email;
                this.user.isAdmin = user.isAdmin;
                this.user.isLoggedIn = true;
            }
        },
        async login(){
            // Incercare login utilizator
            await axios.post('/login', {
                email: this.user.email,
                password: this.user.password,
                device_name: this.device
            }).then(async (response) =>{
                // verificare daca status este 200
                if(response.status === 200){

                    // preluare token in constanta token
                    this.token = response.data;

                    // salvare token in local storage
                    localStorage.setItem('token', this.token);

                    // preluare date utilizator
                    axios.get('/user', {
                        headers:{
                            ContentType: 'application/json',
                            Authorization : 'Bearer ' + this.token
                        }
                    }).then(response=>{
                        const isAdmin = response.data.userType;
                        this.user.isLoggedIn = true;
                        this.$store.dispatch('setLoggedIn', true);

                        this.user.userData = response.data;
                        localStorage.setItem('user', JSON.stringify(response.data));

                        if(isAdmin === 1){
                            this.user.isAdmin = true;
                            this.$store.dispatch('setAdminLoggedIn', true);
                            router.push({name: 'admin-dashboard'})
                        }else{
                            this.user.isAdmin = false;
                            this.$store.dispatch('setAdminLoggedIn', false);
                            router.push({name: 'user-dashboard'})
                        }
                        console.log(response)
                        this.$store.commit('setUser', response.data);

                    })
                }

            });
        }
    },

    components:{
        TopNav
    }
}
</script>

<style scoped>
#loginArea{
    height: 95vh;
    background-color: #dcdde1;
    width: 100vw;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
}
#loginArea_details{
    display: flex;
    flex-direction: row;
    align-self: center;
    justify-content: flex-start;
}
#loginArea_form{
    justify-content: flex-start;
    padding: 80px;
    background-color: #487eb0;
    border-radius: 5px;
    color: #ffffff;
}
#loginArea_form form{
    width: 100%;
    height: 100%;


}
</style>
