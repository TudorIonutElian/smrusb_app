<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <loading-component v-if="loading === true"></loading-component>
        <div class="row" v-if="loading === false">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 my-4 col-flex-space">
                        <span
                            class="badge"
                        >Adaugare adresa {{ this.user.user_first_name + ' ' + this.user.user_last_name}}</span>
                        <div>
                            <button
                                class="btn btn-outline-success"
                                v-if="this.showHide.tabel_campuri === true"
                                @click.prevent="salvareAdresaNoua"
                            >Salveaza Adresa </button>
                            <button class="btn btn-outline-info" @click="showHideAdrese">Vezi Adrese</button>
                        </div>
                    </div>
                </div>
                <div class="row p-1" v-if="this.showHide.tabel_campuri === true">
                    <!-- Judetul de domiciliu -->
                    <div class="col-4 form-group">
                        <label for="angajat_judet_domiciliu" class="form-label">Judetul</label>
                        <select
                            class="form-control form-select"
                            id="angajat_judet_domiciliu"
                            v-model="adresaNoua.judet"
                            @change="preluareLocalitatiByJudet"
                        >
                            <option v-for="judet in judete" :value="judet.id">{{ judet.denumire}}</option>
                        </select>
                    </div>

                    <!-- Localitatea nasterii -->
                    <div class="col-4 form-group">
                        <label for="angajat_localitate_domiciliu" class="form-label">Localitatea</label>
                        <select
                            class="form-control form-select"
                            id="angajat_localitate_domiciliu"
                            v-model="adresaNoua.localitate"
                            :disabled="adresaNoua.judet === 0"
                        >
                            <option v-for="localitate in localitati" :value="localitate.id">{{ localitate.denumire}}</option>
                        </select>
                    </div>

                    <!-- Strada -->
                    <div class="col-4">
                        <label for="angajat_strada_domiciliu" class="form-label">Strada</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_strada_domiciliu"
                            placeholder="Numele strazii"
                            v-model="adresaNoua.strada"
                        >
                    </div>
                </div>
                <div class="row my-2" v-if="this.showHide.tabel_campuri === true">
                    <!-- Numarul Strazii -->
                    <div class="col-4">
                        <label for="angajat_nr_domiciliu" class="form-label">Numarul</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_nr_domiciliu"
                            placeholder="Numarul"
                            v-model="adresaNoua.numar"
                        >
                    </div>
                    <!-- Blocul -->
                    <div class="col-4">
                        <label for="angajat_bloc_domiciliu" class="form-label">Bloc</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_bloc_domiciliu"
                            placeholder="Bloc"
                            v-model="adresaNoua.bloc"
                        >
                    </div>
                    <!-- Scara -->
                    <div class="col-4">
                        <label for="angajat_scara_domiciliu" class="form-label">Scara</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_scara_domiciliu"
                            placeholder="Scara"
                            v-model="adresaNoua.scara"
                        >
                    </div>
                </div>
                <div class="row mt-2" v-if="this.showHide.tabel_campuri === true">
                    <!-- Etaj -->
                    <div class="col-4">
                        <label for="angajat_etaj_domiciliu" class="form-label">Etaj</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_etaj_domiciliu"
                            placeholder="Etaj"
                            v-model="adresaNoua.etaj"
                        >
                    </div>
                    <!-- Apartament -->
                    <div class="col-4">
                        <label for="angajat_apartament_domiciliu" class="form-label">Apartament</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_apartament_domiciliu"
                            placeholder="Apartament"
                            v-model="adresaNoua.apartament"
                        >
                    </div>
                    <!-- Numar de telefon mobil -->
                    <div class="col-4">
                        <label for="angajat_mobil_domiciliu" class="form-label">Telefon mobil</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_mobil_domiciliu"
                            placeholder="Telefon mobil"
                            v-model="adresaNoua.mobil"
                        >
                    </div>
                    <!-- Numar de telefon fix -->
                    <div class="col-4">
                        <label for="angajat_fix_domiciliu" class="form-label">Telefon fix</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_fix_domiciliu"
                            placeholder="Telefon fix"
                            v-model="adresaNoua.fix"
                        >
                    </div>

                    <!-- Profil Facebook -->
                    <div class="col-4">
                        <label for="angajat_fix_domiciliu" class="form-label">Profil Facebook</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_profil_facebook"
                            placeholder="Profil Facebook"
                            v-model="adresaNoua.facebook"
                        >
                    </div>

                    <!-- Profil WhatsApp -->
                    <div class="col-4">
                        <label for="angajat_fix_domiciliu" class="form-label">Profil WhatsApp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_profil_whatsapp"
                            placeholder="Profil WhatsApp"
                            v-model="adresaNoua.whatsapp"
                        >
                    </div>
                </div>
                <div class="row mt-2" id="row-tabel-adrese" v-if="this.showHide.tabel_adrese === true">
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

                                <tr v-for="(adr, index) in lista_adrese">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ adr.aa_judet}}</td>
                                    <td>{{ adr.aa_localitate}}</td>
                                    <td>{{ adr.aa_strada}}</td>
                                    <td>{{ adr.aa_numar}}</td>
                                    <td>{{ adr.aa_bloc}}</td>
                                    <td>{{ adr.aa_scara}}</td>
                                    <td>{{ adr.aa_apartament}}</td>
                                    <td>{{ adr.aa_telefon_fix}}</td>
                                    <td>{{ adr.aa_telefon_mobil}}</td>
                                    <td>
                                        <span v-if="adr.aa_status == 1" class="adresa_activa">Activa</span>
                                        <span v-if="adr.aa_status == 0" class="adresa_inactiva">Inactiva</span>
                                    </td>
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
            user_id: JSON.parse(localStorage.getItem('user')).user_angajat_id,
            user: JSON.parse(localStorage.getItem('user')),
            showHide:{
                tabel_adrese: false,
                tabel_campuri: true
            },
            judete: null,
            localitati: null,
            loading: true,
            adresaNoua:{
                judet: 0,
                localitate: 0,
                strada: "",
                numar: "",
                bloc: "",
                scara: "",
                etaj: "",
                apartament: "",
                mobil: "",
                fix: "",
                facebook: "",
                whatsapp: "",
            },
            lista_adrese: []
        }
    },
    components:{
        TopNav,
        LoadingComponent
    },
    created(){
        this.getJudete();
        this.preluareAdrese();
    },
    methods:{
        async preluareAdrese(){
            this.loading = true;
            axios.get(`/api/angajati/${this.user.user_angajat_id}/adrese`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.lista_adrese = response.data.data
                this.loading = false;
            })
        },
        async salvareAdresaNoua(){
            this.loading = true;
            await axios.post(`/api/angajati/adresa_noua`, {
                adresa: this.adresaNoua,
                user: this.user_id
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                    this.preluareAdrese();
                    this.loading = false;
                    Vue.$toast.open({
                        message: 'Adresa a fost actualizata!',
                        type: 'success',
                        // all of other options may go here
                    });
                }
            )
        },
        async preluareLocalitatiByJudet(){
            this.loading = true;
            await axios.get(`/api/localitati/${this.adresaNoua.judet}`).then(response => {
                    this.localitati = response.data
                    this.loading = false;
                }
            )
        },
        async getJudete(){
            await axios.get(`/api/judete`).then(response => {
                    this.judete = response.data
                    this.loading = false;
                }
            )
        },
        showHideAdrese(){
            this.showHide.tabel_adrese = !this.showHide.tabel_adrese;
            this.showHide.tabel_campuri = !this.showHide.tabel_campuri;
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

.col-flex-space{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}
.adresa_activa{
    padding: 6px;
    background-color: #55efc4;
    border-radius: 3px;
    font-weight: bold;
    color: #fff;
}

.adresa_inactiva{
    padding: 6px;
    background-color: #ff7675;
    border-radius: 3px;
    font-weight: bold;
    color: #fff;
}

</style>
