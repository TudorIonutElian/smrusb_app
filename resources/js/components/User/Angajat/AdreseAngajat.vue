<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 my-4">
                        <span
                            class="badge"
                        >Adaugare adresa {{ this.user.user_first_name + ' ' + this.user.user_last_name}}</span>
                    </div>
                </div>
                <div class="row my-2">
                    <!-- Judetul de domiciliu -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed form-group">
                            <label for="angajat_judet_domiciliu" class="form-label">Judetul</label>
                            <select
                                class="form-control form-select"
                                id="angajat_judet_domiciliu"
                                v-model="angajat_nou.judet_domiciliu"
                                @change="filtrareLocalitatiDomiciuliu()"
                            >
                                <option v-for="judet in this.lista_judete" :value="judet.judet_id">{{ judet.judet_denumire }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- Localitatea nasterii -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed form-group">
                            <label for="angajat_localitate_domiciliu" class="form-label">Localitatea</label>
                            <select
                                class="form-control form-select"
                                id="angajat_localitate_domiciliu"
                                v-model="angajat_nou.localitate_domiciliu"
                            >
                                <option
                                    v-for="localitate_domiciliu in localitati_domiciliu_validate"
                                    :value="localitate_domiciliu.localitate_id"
                                >{{ localitate_domiciliu.localitate_denumire }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Strada -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_strada_domiciliu" class="form-label">Strada</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_strada_domiciliu"
                                placeholder="Numele strazii"
                                v-model="angajat_nou.nume_strada"
                                @blur="validareNumeleStrazii"
                            >
                        </div>
                        <div class="col-12 col-12-flexed" v-if="erori.nume_strada">
                            <label for="eroare_nume_strada" class="form-label"></label>
                            <div id="eroare_nume_strada" class="eroare error">Numele strazii trebuie sa aiba cel putin 3 caractere!</div>
                        </div>
                    </div>
                    <!-- Numarul Strazii -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_nr_domiciliu" class="form-label">Numarul</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_nr_domiciliu"
                                placeholder="Numarul"
                                v-model="angajat_nou.numar_strada"
                            >
                        </div>
                    </div>
                    <!-- Blocul -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_bloc_domiciliu" class="form-label">Bloc</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_bloc_domiciliu"
                                placeholder="Bloc"
                                v-model="angajat_nou.bloc_domiciliu"
                            >
                        </div>
                    </div>
                    <!-- Scara -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_scara_domiciliu" class="form-label">Scara</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_scara_domiciliu"
                                placeholder="Scara"
                                v-model="angajat_nou.scara_domiciliu"
                            >
                        </div>
                    </div>
                    <!-- Etaj -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_etaj_domiciliu" class="form-label">Etaj</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_etaj_domiciliu"
                                placeholder="Etaj"
                                v-model="angajat_nou.etaj_domiciliu"
                            >
                        </div>
                    </div>
                    <!-- Apartament -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_apartament_domiciliu" class="form-label">Apartament</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_apartament_domiciliu"
                                placeholder="Apartament"
                                v-model="angajat_nou.apartament_domiciliu"
                            >
                        </div>
                    </div>
                    <!-- Numar de telefon mobil -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_mobil_domiciliu" class="form-label">Telefon mobil</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_mobil_domiciliu"
                                placeholder="Telefon mobil"
                                v-model="angajat_nou.telefon_mobil"
                            >
                        </div>
                    </div>
                    <!-- Numar de telefon fix -->
                    <div class="row p-1">
                        <div class="col-12 col-12-flexed">
                            <label for="angajat_fix_domiciliu" class="form-label">Telefon fix</label>
                            <input
                                type="text"
                                class="form-control"
                                id="angajat_fix_domiciliu"
                                placeholder="Telefon fix"
                                v-model="angajat_nou.telefon_fix"
                            >
                        </div>
                    </div>
                    <div class="row row-pink mt-2">
                        <div class="col-12 p-1">
                            <span>Profile Social Media</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">Judet</th>
                                <th scope="col">Localitate</th>
                                <th scope="col">Strada</th>
                                <th scope="col">Numar</th>
                                <th scope="col">Bloc</th>
                                <th scope="col">Scara</th>
                                <th scope="col">Apartament</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Stare</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from '../../Menus/TopNav'
import LoadingComponent from "../../HelperComponents/LoadingComponent";

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
span.badge{
    padding: 10px;
    background-color: #3498db;
    font-size: 16px;
    color: #fff;
}
</style>
