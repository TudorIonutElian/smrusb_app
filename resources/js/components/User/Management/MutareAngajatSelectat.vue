<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <!-- row profil utilizator -->
                <div class="row mt-2">
                    <div class="col-4 col-profile">
                        <div class="row-profile">
                            <div class="row-profile-template-full p-2">Date Angajat</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Nume</div>
                            <div class="row-profile-info"> Popescu</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Prenume</div>
                            <div class="row-profile-info">Adrian</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Data nasterii</div>
                            <div class="row-profile-info">12.01.1975</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Varsta</div>
                            <div class="row-profile-info">45 ani</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Institutie</div>
                            <div class="row-profile-info">Agentia Nationala de Administrare Fiscala</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Functie</div>
                            <div class="row-profile-info">Director general</div>
                        </div>
                        <div class="row-profile">
                            <div class="row-profile-template">Pozitie</div>
                            <div class="row-profile-info">0001</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-info p-2 text-center">
                                    Mutare angajat
                                </div>
                                <div class="col-12 p-2">
                                    <form>
                                        <div class="mb-3">
                                            <label for="numar_act_mutare" class="form-label">Numarul actului administrativ: </label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="numar_act_mutare"
                                                v-model="mutare.numar_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_emitere_act" class="form-label">Data emitere act administrativ: </label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="data_emitere_act"
                                                v-model="mutare.data_emitere_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_aplicare_act" class="form-label">Data aplicare act administrativ: </label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="data_aplicare_act"
                                                v-model="mutare.data_aplicare_act_administrativ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mutare_angajat_institutie" class="form-label">Selectati institutia: </label>
                                            <select
                                                class="form-control form-select"
                                                id="mutare_angajat_institutie"
                                                v-model="mutare.institutie_id"
                                            >
                                                <option
                                                    v-for="i in lista_institutii_all"
                                                    :value="i.institutie_id"
                                                >{{ i.institutie_denumire }}</option>
                                            </select>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary btn-block"
                                            @click.prevent="mutareAngajat()"
                                        >Muta Angajat</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";

export default {
    data(){
        return{
            token: localStorage.getItem('token'),
            user_id: JSON.parse(localStorage.getItem('user')).id,
            lista_institutii_all: [],
            mutare:{
                numar_act_administrativ: "",
                data_emitere_act_administrativ: "",
                data_aplicare_act_administrativ: "",
                institutie_id: 0
            }

        }
    },
    created(){
        this.preluareInstitutii();
    },
    components:{
        TopNav
    },
    methods:{
        async preluareInstitutii(){
            await axios.get('/api/institutii/all').then(response=>{
                this.lista_institutii_all = response.data.data;
            })
        },
        async mutareAngajat(){
            console.log(this.mutare)
        }
    }
}
</script>

<style scoped>
.row-profile{
    display: flex;
    flex-direction: row;
    justify-content: space-around;

}
.row-profile-template-full{
    width: 100%;
    text-align: center;
    padding: 5px;
    font-weight: bold;
    color: #04ccf6;
}
.row-profile-template{
    width: 50%;
    text-align: right;
    padding: 5px;
    font-weight: bold;
}
.row-profile-info{
    width: 50%;
    text-align: left;
    padding: 5px;
}
.col-info{
    padding: 10px;
    color: #04ccf6;
    font-weight: bold;
}
.col-table table.table{
    max-width: 100%;
    box-sizing: border-box;
}
</style>
