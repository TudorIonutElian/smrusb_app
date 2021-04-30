<template>
    <div class="row mt-2">
        <div class="col-12">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12 bg-angajat-dashboard">Panou de Control Angajat</div>
                </div>
                <div class="row my-3 row-flex">
                    <div class="col-3 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2">
                            Adrese
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>0</span>
                        </div>
                        <div class="my-2">
                            <button class="btn btn-info btn-block text-white">Vezi Adrese</button>
                        </div>
                    </div>

                    <div class="col-3 offset-1 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2">
                            Salarii
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>0</span>
                        </div>
                        <div class="my-2">
                            <button class="btn btn-info btn-block text-white">Vezi Adrese</button>
                        </div>
                    </div>

                    <div class="col-3 offset-1 p-3 angajat-block">
                        <div class="angajat-bloc_adresa my-2">
                            Pontaje
                        </div>
                        <div class="angajat-bloc_numeric my-2">
                            <span>0</span>
                        </div>
                        <div class="my-2">
                            <button class="btn btn-info btn-block text-white">Vezi Adrese</button>
                        </div>
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
            token: localStorage.getItem('token'),
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            },
            lista_angajati: [],
            user_id: JSON.parse(localStorage.getItem('user')).id,
            lista_acces: [],
            user: JSON.parse(localStorage.getItem('user'))
        }
    },
    components:{
        TopNav
    },
    created(){
        this.preluareAngajati();
    },
    methods:{
        async preluareAngajati(){
            axios.get(`/api/angajati/${this.user_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                console.log(response)
                this.lista_angajati = response.data.data
            })
        }
    }
}
</script>

<style scoped>
.btn-show{
    border: none;
}
.bg-angajat-dashboard{
    background-color: #60a3bc;
    color: #fff;
    font-weight: bolder;
    padding: 10px;
}
.row-flex{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.angajat-block{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #dfe6e9;
}
.angajat-bloc_adresa{
    display: block;
    background-color: #60a3bc;
    color: #fff;
    font-weight: bold;
    padding: 5px;
    width: 60%;
    text-align: center;
}
.angajat-bloc_numeric{
    font-size: 3rem;
    color: #60a3bc;
    font-weight: bold;
}
</style>
