<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr class="bg-success text-white">
                                <th scope="col">#</th>
                                <th scope="col">Nume</th>
                                <th scope="col">Prenume</th>
                                <th scope="col">CNP</th>
                                <th scope="col">Institutia</th>
                                <th scope="col">Functia</th>
                                <th scope="col">Fisa Evidenta</th>
                            </tr>
                            </thead>
                            <tbody class="angajati">
                            <tr v-for="(angajat, index) in lista_angajati_filtrat">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ angajat.angajat_nume }}</td>
                                <td>{{ angajat.angajat_prenume }}</td>
                                <td>{{ angajat.angajat_cnp }}</td>
                                <td>{{ angajat.angajat_institutie }}</td>
                                <td>
                                    <span v-if="angajat.angajat_status != 0">
                                        {{
                                            angajat.angajat_functie ? angajat.angajat_functie : 'Nu este numit.'
                                        }}
                                    </span>
                                    <span v-if="angajat.angajat_status == 0" class="contract_incetat">Contract incetat</span>
                                </td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-primary"
                                        @click.prevent="eliberareAdeverinta(index)"
                                        :disabled="angajat.angajat_status == 0"
                                    >
                                        Eliberare Adeverinta
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button
                            class="btn btn-primary" @click.prevent="salveazaAdeverintaPDF"
                            :disabled="adeverinta_generata === false"
                        >Salveaza PDF</button>
                    </div>
                </div>
                <div class="row" id="adeverintaGenerata" v-if="angajat_id != null">
                    <div class="container-fluid">
                        <div class="row row-1">
                            <div class="col-left">
                                <p class="denumire_tara">Romania</p>
                                <p class="denumire_institutie">{{ lista_angajati_filtrat[this.angajat_id].angajat_institutie }}</p>
                            </div>
                            <div class="col-right">
                                <span>Numar de inregistrare: ___________________</span>
                                <span>Data inregistrarii:    {{ this.today }} </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-adeverinta-center">
                                ADEVERINTA
                            </div>
                        </div>
                        <div class="row" id="adeverint_text">
                            <div class="col-text-general">
                                <span class="col-text-general_tab">Prin</span> prezenta se adevereste ca domnul / doamna
                                {{ lista_angajati_filtrat[this.angajat_id].angajat_nume }} {{ lista_angajati_filtrat[this.angajat_id].angajat_prenume }}
                                nascut la data de {{ lista_angajati_filtrat[this.angajat_id].angajat_dob }}, avand codul numeric personal {{ lista_angajati_filtrat[this.angajat_id].angajat_cnp }}                       este angajat la
                                <span class="col-text-general_institutie">{{ lista_angajati_filtrat[this.angajat_id].angajat_institutie }}</span>,
                                incepand cu data de 01-01-2000, fiind numit in functia de
                                <span class="col-text-general_functie">{{ validareFunctie(lista_angajati_filtrat[this.angajat_id].angajat_functie) }}</span>.
                            </div>
                            <div class="col-12 mt-2">
                                <span class="col-text-general_tab">Prezenta</span> adeverinta a fost eliberata la cererea persoanei in cauza.
                            </div>
                            <div class="col-12">
                                <span class="col-text-general_tab">Prezenta</span> adeverinta a fost eliberata la data de <span class="data_curenta">{{ this.today }}</span>.
                            </div>
                            <div class="col-12">
                                <span class="col-text-general_tab">Prezenta</span> adeverinta este valabila pana la data de <span class="data_curenta">{{ this.val_date }}</span>.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="adeverinta_semnatura">
                                <span>DIRECTOR GENERAL</span>
                                <img src="/images/smrusb.png" alt="" width="150px">
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
import {jsPDF} from "jspdf";

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
            lista_angajati_filtrat: null,
            angajat_id: null,
            today: null,
            val_date: null,
            adeverinta_generata: false
        }
    },
    created(){
        this.preluareAngajati();
    },
    components:{
        TopNav,
    },
    methods:{
        async preluareAngajati(){
            const user_id = this.user.id;
            axios.get(`/api/angajati/${user_id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.lista_angajati_filtrat = response.data.data
            })
        },
        eliberareAdeverinta(id){
            this.angajat_id = id;
            let astazi = new Date();
            let dd = String(astazi.getDate()).padStart(2, '0');
            let mm = String(astazi.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = astazi.getFullYear();

            astazi = dd + '-' + mm + '-' + yyyy;
            this.today = astazi;

            let val_date = new Date();
            val_date.setDate(val_date.getDate() + 30);

            let dd_val = String(val_date.getDate()).padStart(2, '0');
            let mm_val = String(val_date.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy_val = val_date.getFullYear();

            val_date = dd_val + '-' + mm_val + '-' + yyyy_val;
            this.val_date = val_date;

            Vue.$toast.open({
                message: 'Adeverinta a fost generata!',
                type: 'success',
                // all of other options may go here
            });
            this.adeverinta_generata = true;

        },
        salveazaAdeverintaPDF(){

            const adeverintaGenerata = document.getElementById('adeverintaGenerata');
            adeverintaGenerata.style.visibility = "visible";

            const doc = new jsPDF({
                orientation: 'p',
                unit: 'pt',
                format: 'a4',
                putOnlyUsedFonts:true,
            });
            doc.setFontSize(16)
            doc.html(adeverintaGenerata, {
                callback: function() {
                    doc.save("adeverinta.pdf");
                }
            });

            Vue.$toast.open({
                message: 'Adeverinta a fost salvata!',
                type: 'success',
                // all of other options may go here
            });
        },
        validareFunctie(functie){
            if(functie != null){
                return functie;
            }else{
                return 'nu este numit.'
            }
        }
    }
}
</script>

<style scoped>
.col-8 span,
.col-4 span{
    display: inline-block;
}
.denumire_tara{
    margin : 0;
    padding: 0;
    font-weight: bold;
    text-transform: uppercase;
}

.col-adeverinta-center{
    width: 600px;
    text-align: center;
    font-size: 30px;
    margin-top: 10px;
    margin-bottom: 10px;
    text-text-replace: uppercase;
    font-weight: bold;
}
.row-1{
    width: 60%;
}
.row-1{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-items: flex-start;
}
.col-left{
    width: 450px;
    margin-left: 30px;
    margin-top: 10px;
    background-color: #273c75;
    color: #fff;
    font-weight: bold;
    padding: 10px;
    border-radius: 5px;
}
.col-right{
    width: 320px;
    margin-left: 30px;
    margin-top: 10px;
    background-color: #f5f6fa;
    color: #333;
    padding: 10px;
    border-radius: 5px;
}
.col-right span{
    display: block;
}

.col-text-general{
    max-width: 600px;
    margin-right: 30px;
    padding: 5px;
    text-align: justify;
}
#adeverintaGenerata{
    visibility: hidden;
}
#adeverint_text div{
    margin-right: 30px;
    text-align: justify;
    padding-left: 30px;
}
#adeverinta_semnatura{
    margin-top: 40px;
    max-width: 600px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-items: center;
}
.data_curenta{
    font-weight: bolder;
}
.col-text-general_tab{
    padding-left: 50px;
}

.col-text-general_institutie,
.col-text-general_functie{
    font-weight: bolder;
    font-style: italic;
}
.contract_incetat{
    color: #e74c3c;
    font-weight: bold;
}
</style>
