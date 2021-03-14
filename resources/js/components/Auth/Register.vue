<template>
    <div id="registerPage">
        <top-nav></top-nav>
        <div class="container-register mt-2 p-4">
            <div id="registerArea">
                    <div class="my-4 text-white bg-success p-3 text-center">Solicitare acces la SIC SMRUSB</div>
                    <form class="form">
                        <div class="mb-3">
                            <label class="form-label">Numele dumneavoastra</label>
                            <input type="text" class="form-control w-100" v-model="user.user_first_name">
                            <div>Va rugam sa introduceti numele dumneavoastra, asa cum apare pe contractul de munca!</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prenumele dumneavoastra</label>
                            <input type="text" class="form-control w-100" v-model="user.user_last_name">
                            <div>Va rugam sa introduceti numele dumneavoastra, asa cum apare pe contractul de munca!</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresa de email: </label>
                            <input type="text" class="form-control w-100" v-model="user.user_email">
                            <div>Va rugam sa introduceti numele dumneavoastra, asa cum apare pe contractul de munca!</div>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-select" id="angajat_judet_domiciliu" v-model="user.user_acces_level">
                                <option v-for="institutie in institutii" :key="institutii.id" :value="institutie.id" >{{ institutie.institutie_denumire }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Introduceti o parola (minim 8 caracter)</label>
                            <input type="password" class="form-control w-100" v-model="user.user_password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reintroduceti parola</label>
                            <input type="password" class="form-control w-100" v-model="user.user_password_check">
                        </div>
                        <button class="btn btn-outline-light btn-block mt-2" @click.prevent="inregistrareUtilizator">Trimite cererea</button>
                    </form>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import router from "../../router/router";
export default {
    data(){
        return{
            user:{
                user_first_name: null,
                user_last_name: null,
                user_email: null,
                user_password: null,
                user_password_check: null,
                user_acces_level: null
            },
            institutii: []
        }
    },
    created() {
        this.preluareInstitutii();
    },
    computed:{
        validatedUsername: function(){
            const username = this.user.user_first_name.replace(/\s/g, "").concat(this.user.user_last_name.replace(/\s/g, "")).toLowerCase();
            return username;
        },
        validatePassword: function (){
            return this.user.user_password === this.user.user_password_check;
        }
    },
    methods:{
        async inregistrareUtilizator(){
            if(this.validatePassword){
                await axios.post('/api/users/inregistrare', {
                    user_first_name: this.user.user_first_name,
                    user_last_name: this.user.user_last_name,
                    user_email: this.user.user_email,
                    user_username: this.validatedUsername,
                    user_password: this.user.user_password,
                    user_acces_level: this.user.user_acces_level
                }).then(response =>{
                    if(response.data.status === 200){
                        router.push('login')
                    }
                })
            }
        },
        async preluareInstitutii(){
            await axios.get('/api/users/inregistrare/institutii').then(response =>{
                this.institutii = response.data;
            })
        }
    },
    components: {TopNav}
}
</script>

<style scoped>
#registerPage{
    background-color: #dcdde1;
}
.container-register{
    width: 100%;
    min-height: 94.5vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.container-register #registerArea{
    padding: 60px;
    width: 40%;
    min-height: 100%;
    background-color: #487eb0;
    color: #ffffff;
    border-radius: 10px;
}
</style>
