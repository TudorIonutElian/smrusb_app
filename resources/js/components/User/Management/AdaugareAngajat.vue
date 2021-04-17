<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row" v-show="showLoadingAnimation">
            <div class="container mt-4">
                <div class="row row-bordered p-2">
                    <div class="col-12 p-1 text-center">
                        Adauga Angajat Nou
                    </div>
                </div>
                <div class="row row-blue mt-2">
                    <div class="col-12 p-1">
                        <span>Date Angajare</span>
                    </div>
                </div>
                <div class="row p-1 mt-2">
                    <div class="col-12 col-12-flexed" >
                        <label for="numar_act_mutare" class="form-label">Numarul actului administrativ: </label>
                        <input
                            type="text"
                            class="form-control"
                            id="numar_act_mutare"
                            v-model="angajat_nou.numar_act_angajare"
                        >
                    </div>
                </div>
                <div class="row p-1">
                    <div class="col-12 col-12-flexed" >
                        <label for="data_emitere_act" class="form-label">Data emitere act administrativ: </label>
                        <input
                            type="date"
                            class="form-control"
                            id="data_emitere_act"
                            v-model="angajat_nou.data_emitere_act_angajare"
                        >
                    </div>
                </div>
                <div class="row p-1">
                    <div class="col-12 col-12-flexed" >
                        <label for="data_aplicare_act_angajare" class="form-label">Data aplicare act administrativ: </label>
                        <input
                            type="date"
                            class="form-control"
                            id="data_aplicare_act_angajare"
                            v-model="angajat_nou.data_aplicare_act_angajare"
                        >
                    </div>
                </div>

                <div class="row row-blue mt-2">
                    <div class="col-12 p-1">
                        <span>Date Personale</span>
                    </div>
                </div>
                <!-- Numele Angajatului-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed" >
                        <label for="angajat_nume" class="form-label">Nume</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_nume"
                            placeholder="Numele"
                            v-model="angajat_nou.nume"
                            @blur="validareNume"
                        >

                    </div>
                    <div class="col-12 col-12-flexed" v-if="erori.nume">
                        <label for="eroare_nume" class="form-label"></label>
                        <div id="eroare_nume" class="eroare error">Numele trebuie sa aiba cel putin 3 caractere!</div>
                    </div>
                </div>
                <!-- Prenumele Tatalui-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_prenume_tata" class="form-label">Prenume tata</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_prenume_tata"
                            placeholder="Prenumele tatalui"
                            v-model="angajat_nou.prenume_tata"
                            @blur="validarePrenumeTata"
                        >
                    </div>
                    <div class="col-12 col-12-flexed" v-if="erori.prenume_tata">
                        <label for="eroare_prenume_tata" class="form-label"></label>
                        <div id="eroare_prenume_tata" class="eroare error">Prenumele tatalui trebuie sa aiba cel putin 3 caractere!</div>
                    </div>
                </div>
                <!-- Prenumele Mamei-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_prenume_mama" class="form-label">Prenume mama</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_prenume_mama"
                            placeholder="Prenumele mamei"
                            v-model="angajat_nou.prenume_mama"
                            @blur="validarePrenumeMama"
                        >
                    </div>
                    <div class="col-12 col-12-flexed" v-if="erori.prenume_mama">
                        <label for="eroare_prenume_mama" class="form-label"></label>
                        <div id="eroare_prenume_mama" class="eroare error">Prenumele mamei trebuie sa aiba cel putin 3 caractere!</div>
                    </div>
                </div>
                <!-- Prenumele Angajatului-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_prenume" class="form-label">Prenume</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_prenume"
                            placeholder="Prenumele"
                            v-model="angajat_nou.prenume"
                            @blur="validarePrenume"
                        >
                    </div>
                    <div class="col-12 col-12-flexed" v-if="erori.prenume">
                        <label for="eroare_prenume_angajat" class="form-label"></label>
                        <div id="eroare_prenume_angajat" class="eroare error">Prenumele trebuie sa aiba cel putin 3 caractere!</div>
                    </div>
                </div>
                <!-- Cod Numeric Personal -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_cnp" class="form-label">CNP</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_cnp"
                            placeholder="Codul numeric personal"
                            v-model="angajat_nou.cnp"
                            @blur="validareCNP"
                        >
                    </div>
                    <div class="col-12 col-12-flexed" v-if="erori.cnp">
                        <label for="eroare_cnp" class="form-label"></label>
                        <div id="eroare_cnp" class="eroare error">CNP-ul trebuie sa aiba 13 cifre!</div>
                    </div>
                </div>
                <!-- Nume anterior -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_nume_anterior" class="form-label">Numele anterior</label>
                        <input
                            type="text"
                            class="form-control"
                            id="angajat_nume_anterior"
                            placeholder="Nume anterior"
                            v-model="angajat_nou.nume_anterior"
                        >
                    </div>
                </div>
                <!-- Data nasterii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_data_nastere" class="form-label">Data Nasterii</label>
                        <input
                            type="date"
                            class="form-control"
                            id="angajat_data_nastere"
                            v-model="angajat_nou.data_nasterii"
                        >
                    </div>
                </div>
                <!-- Starea Civila -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_starea_civila" class="form-label">Starea civila</label>
                        <select
                            class="form-control form-select"
                            id="angajat_starea_civila"
                            v-model="angajat_nou.stare_civila"
                        >
                            <option value="0" selected>Nespecificat</option>
                            <option value="1">Necasatorit(a)</option>
                            <option value="2">Casatorit(a)</option>
                            <option value="3">Divortat(a)</option>
                        </select>
                    </div>
                </div>
                <!-- Judetul nasterii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_judet_nastere" class="form-label">Judetul nasterii</label>
                        <select
                            class="form-control form-select"
                            id="angajat_judet_nastere"
                            v-model="angajat_nou.judet_nastere"
                            @change="filtrareLocalitatiNastere()"
                        >
                            <option v-for="judet in judete_nastere" :value="judet.judet_id">{{ judet.judet_denumire }}</option>
                        </select>
                    </div>
                </div>
                <!-- Localitatea nasterii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_localitate_nastere" class="form-label">Localitatea nasterii</label>
                        <select
                            class="form-control form-select"
                            id="angajat_localitate_nastere"
                            v-model="angajat_nou.localitate_nastere"
                        >
                            <option v-for="localitate_nastere in localitati_nastere_validate" :value="localitate_nastere.localitate_id">
                                {{ localitate_nastere.localitate_denumire }}</option>
                        </select>
                    </div>
                </div>
                <!-- Institutia angajarii-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_institutie" class="form-label">Institutie</label>
                        <select
                            class="form-control form-select"
                            id="angajat_institutie"
                            v-model="angajat_nou.acces_level"
                        >
                            <option v-for="institutie in user_institutii_acces" :value="institutie.id">{{ institutie.institutie_denumire}}</option>
                        </select>
                    </div>
                </div>

                <div class="row row-green mt-2">
                    <div class="col-12 p-1">
                        <span>Adresa de domiciliu</span>
                    </div>
                </div>

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
                <!-- Facebook Link -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">
                            <img class="mr-2" src="/images/facebook.png" alt="">
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Link Facebook"
                            v-model="angajat_nou.link_facebook"
                        >
                    </div>
                </div>
                <!-- Twitter Link -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">
                            <img class="mr-2" src="/images/twitter.png" alt="">
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Link Twitter"
                            v-model="angajat_nou.link_twitter"
                        >
                    </div>
                </div>
                <!-- Google Link -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">
                            <img class="mr-2" src="/images/google-plus.png" alt="">
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Link Google Plus"
                            v-model="angajat_nou.link_google"
                        >

                    </div>
                </div>
                <!-- Youtube Link -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">
                            <img class="mr-2" src="/images/youtube.png" alt="">
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Link Youtube"
                            v-model="angajat_nou.link_youtube"
                        >
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-12">
                        <button @click.prevent="adaugaAngajat()"
                                type="button" class="btn btn-adauga-angajat btn-block">
                            Adauga Angajat Nou
                        </button>
                    </div>
                </div>
                <notifications group="angajat" position="bottom right"/>
            </div>
        </div>
        <loading-component v-show="!showLoadingAnimation"></loading-component>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
import LoadingComponent from "../../HelperComponents/LoadingComponent";
import router from "../../../router/router";

export default {
    data(){
        return{
            user_institutii_acces: [],
            lista_judete: [],
            lista_localitati: [],
            token: localStorage.getItem('token'),
            angajat_nou: {
                nume: "",
                prenume_tata: "",
                prenume_mama: "",
                prenume: "",
                nume_anterior: "",
                cnp: "",
                data_nasterii: "",
                stare_civila: "",
                judet_nastere: "",
                localitate_nastere: "",
                judet_domiciliu: "",
                localitate_domiciliu: "",
                nume_strada: "",
                numar_strada: "",
                bloc_domiciliu: "",
                scara_domiciliu: "",
                etaj_domiciliu: "",
                apartament_domiciliu: "",
                telefon_mobil: "",
                telefon_fix: "",
                link_facebook: "",
                link_twitter: "",
                link_google: "",
                link_youtube: "",
                acces_level: 0,
                // date angajare
                numar_act_angajare: "",
                data_emitere_act_angajare: "",
                data_aplicare_act_angajare: ""
            },
            erori:{
                nume: false,
                prenume_tata: false,
                prenume_mama: false,
                prenume: false,
                data_nasterii: false,
                nume_strada: false,
                cnp: false
            },
            lista_erori: [],
            localitati_nastere_validate: [],
            localitati_domiciliu_validate: []
        }
    },
    components:{
        TopNav,
        LoadingComponent
    },
    computed:{
        angajatValid(){
            return this.lista_erori.length === 0
        },
        showLoadingAnimation(){
            return this.lista_judete.length > 0 && this.lista_localitati.length > 0 && this.user_institutii_acces.length > 0
        },
        judete_nastere(){
            return this.lista_judete.sort((a, b)=>{
                a.judet_denumire.localeCompare(b.judet_denumire);
            });
        },
    },
    async created() {
        await this.preluareJudete();
        await this.preluareLocalitati();
        await this.preluareInstitutiiAcces();
    },
    methods:{
        filtrareLocalitatiNastere(){
            this.localitati_nastere_validate = [];
            for(let i = 0; i < this.lista_localitati.length; i++){
                if(this.lista_localitati[i].localitate_judet_id === this.angajat_nou.judet_nastere){
                    this.localitati_nastere_validate.push(this.lista_localitati[i])
                }
            }
        },
        filtrareLocalitatiDomiciuliu(){
            this.localitati_domiciliu_validate = [];
            for(let i = 0; i < this.lista_localitati.length; i++){
                if(this.lista_localitati[i].localitate_judet_id === this.angajat_nou.judet_domiciliu){
                    this.localitati_domiciliu_validate.push(this.lista_localitati[i])
                }
            }
        },
        async preluareJudete(){
            await axios.get('/api/judete/all').then(response=>{
                this.lista_judete = response.data.data;
            })
        },
        async preluareLocalitati(){
            await axios.get('/api/localitati/adrese').then(response=>{
                this.lista_localitati = response.data.data;
            })
        },
        async preluareInstitutiiAcces(){
            const user_id = JSON.parse(localStorage.getItem('user')).id;
            await axios.get("/api/users/institutii/acces/" + user_id, {
                ContentType: 'application/json',
                Authorization : 'Bearer ' + this.token
            }).then(response => {
                    this.user_institutii_acces = response.data
                }
            )
        },
        async adaugaAngajat(){
            this.validareAngajatNou()
        },

        // Validari
        validareNume(){
            if(this.angajat_nou.nume.length < 3){
                this.erori.nume = true
            }else{
                this.erori.nume = false;
            }
        },
        validarePrenumeTata(){
            if(this.angajat_nou.prenume_tata.length < 3){
                this.erori.prenume_tata = true
            }else{
                this.erori.prenume_tata = false;
            }
        },
        validarePrenumeMama(){
            if(this.angajat_nou.prenume_mama.length < 3){
                this.erori.prenume_mama = true
            }else{
                this.erori.prenume_mama = false;
            }
        },
        validarePrenume(){
            if(this.angajat_nou.prenume.length < 3){
                this.erori.prenume = true
            }else{
                this.erori.prenume = false;
            }
        },
        validareCNP(){
            if(this.angajat_nou.cnp.length !== 13){
                this.erori.cnp = true
            }else{
                this.erori.cnp = false;
            }
        },
        validareNumeleStrazii(){
            if(this.angajat_nou.nume_strada.length < 3){
                this.erori.nume_strada = true
            }else{
                this.erori.nume_strada = false;
            }
        },
        async validareAngajatNou(){
            this.lista_erori = [];

            // Verificare stringuri minim 3 caractere
            Object.keys(this.angajat_nou).forEach(proprietate_angajat => {
                if(proprietate_angajat === "nume" && this.angajat_nou[proprietate_angajat].length < 3){
                    this.erori[proprietate_angajat] = true
                }

                if(proprietate_angajat === "prenume_tata" && this.angajat_nou[proprietate_angajat].length < 3){
                    this.erori[proprietate_angajat] = true
                }
                if(proprietate_angajat === "prenume_mama" && this.angajat_nou[proprietate_angajat].length < 3){
                    this.erori[proprietate_angajat] = true
                }

                if(proprietate_angajat === "prenume" && this.angajat_nou[proprietate_angajat].length < 3){
                    this.erori[proprietate_angajat] = true
                }

                if(proprietate_angajat === "nume_strada" && this.angajat_nou[proprietate_angajat].length < 3){
                    this.erori[proprietate_angajat] = true
                }
            });

            for (const eroare in this.erori) {
                if(this.erori[eroare] === true){
                    this.lista_erori.push(eroare)
                }
            }

            if(this.angajatValid){
                await axios.post('/api/angajati/adaugare', {
                    angajat: this.angajat_nou,
                }, {
                    headers:{
                        ContentType: 'application/json',
                        Authorization : 'Bearer ' + this.token
                    }
                }).then(response => {
                    if(response.data.cod === '001'){
                        this.$notify({
                            group: 'angajat',
                            title: 'Angajat Adaugat',
                            text: 'Angajatul a fost salvat in baza de date!',
                            type: 'success'
                        });
                        router.push({name: 'user-dashboard'});
                    }else if(response.data.cod === '000'){
                        this.$notify({
                            group: 'angajat',
                            title: 'Eroare',
                            text: 'CNP duplicat! Angajatul exista deja',
                            type: 'warn'
                        });
                    }
                })
            }
        }
    }
}
</script>

<style scoped>
.row-bordered{
    border: 1px solid #273c75;
    color: #273c75;;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}
.row-bordered{
    border-radius: 5px;
}
.col-12-flexed{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}
.col-12-flexed label{
    width: 20%;
    color: #04ccf6;
    font-weight: bold;
    text-align: right;
    padding-right: 10px;
}
.col-12-flexed select{
    width: 100%;
}
.col-12-flexed div {
    width: 20%;
}
.col-12-flexed div.error {
    width: 80%;
}
.row.row-blue .col-12 span{
    padding: 8px;
    background-color: #273c75;
    color: #fff;
    font-weight: bolder;
    border-radius: 5px;
}

.row.row-green .col-12 span{
    padding: 8px;
    background-color: #273c75;
    color: #fff;
    font-weight: bolder;
    border-radius: 5px;
}
.row.row-pink .col-12 span{
    padding: 8px;
    background-color: #273c75;
    color: #fff;
    font-weight: bolder;
    border-radius: 5px;
}
.btn-adauga-angajat{
    background-color: #273c75;
    color: #fff;
    border-radius: 5px;
    font-weight: bold;
}

.eroare{
    font-weight: bold;
    color: #e74c3c;
}
</style>
