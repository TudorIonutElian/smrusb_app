<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div v-if="loading === false" class="container-fluid mt-2 p-1">
            <div class="row">
                <div class="col-12 bg-primary-blue p-2 text-center">
                    Dosar Angajat - Fisa Evidenta date
                </div>
            </div>
            <!-- row profil utilizator -->
            <div class="row mt-2">
                <div class="col-2 col-profile p-3">
                    <div class="row-profile my-4">
                        <div class="row-profile-template-full-flex p-2">
                            <img alt="" class="mr-2" src="/images/user.png">
                        </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template-full p-2">Date personale angajat</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nume</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_nume }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Prenume Tata</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_prenume_tata }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Prenume Mama</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_prenume_mama }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Prenume</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_prenume }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">CNP</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_cnp }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Data nasterii</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_data_nasterii }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nascut in judetul:</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_judet_nastere }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nascut in localitatea:</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_localitate_nastere }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nume anterior</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_nume_anterior }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Stare civila</div>
                        <div class="row-profile-info"> {{
                                stareCivila(date_fisa.date_personale.angajat_stare_civila)
                            }}
                        </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nivel Acces</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_nivel_acces }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Email</div>
                        <div class="row-profile-info">popescuadrian@gmail.com</div>
                    </div>
                </div>
                <div class="col-10 p-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="btn-group">
                                    <button
                                        @click.prevent="goToNumireAngajat"
                                        class="btn btn-primary"
                                        :disabled="date_fisa.stare_contract == 0"
                                        :class="date_fisa.stare_contract == 0 ? 'btn-disabled' : '' "
                                    >
                                        Numire Angajat</button>
                                    <button
                                        @click.prevent="goToMutareAngajat"
                                        class="btn btn-primary"
                                        :disabled="date_fisa.stare_contract == 0"
                                        :class="date_fisa.stare_contract == 0 ? 'btn-disabled' : '' "
                                    >Mutare Angajat</button>

                                    <button
                                        @click.prevent="goToIncetareContract"
                                        class="btn btn-primary"
                                        :disabled="date_fisa.stare_contract == 0"
                                        :class="date_fisa.stare_contract == 0 ? 'btn-disabled' : '' "
                                    >Incetare Contract</button>

                                    <button
                                        @click.prevent="goToAdaugareCalificativ"
                                        class="btn btn-primary"
                                        :disabled="date_fisa.stare_contract == 0"
                                        :class="date_fisa.stare_contract == 0 ? 'btn-disabled' : '' "
                                    >Adaugare Calificativ</button>
                                    <button
                                        class="btn btn-primary"
                                        :disabled="date_fisa.stare_contract == 0"
                                        :class="date_fisa.stare_contract == 0 ? 'btn-disabled' : '' "
                                    >Adaugare Recompense</button>
                                    <button
                                        @click.prevent="goToAdeverintaAngajat"
                                        class="btn btn-success"
                                    >Adeverinta Angajat</button>
                                    <button
                                        @click.prevent="goToAdeverintaAsigurat"
                                        class="btn btn-success"
                                    >Adeverinta Asigurat</button>
                                    <button
                                        @click.prevent="goToAdeverintaSalarii"
                                        class="btn btn-success"
                                    >Adeverinta Salarii</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link active"
                                                id="mutatii-tab" data-bs-toggle="tab"
                                                data-bs-target="#mutatii"
                                                type="button" role="tab"
                                                aria-controls="mutatii"
                                                aria-selected="true">
                                                Istoric Mutatii Profesionale
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link"
                                                id="salarii-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#salarii"
                                                type="button"
                                                role="tab"
                                                aria-controls="salarii"
                                                aria-selected="false">
                                                Salarii Angajat
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link"
                                                id="grafic-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#grafic"
                                                type="button"
                                                role="tab"
                                                aria-controls="grafic"
                                                aria-selected="false">
                                                Grafic Salarii Angajat
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link"
                                                id="evaluari-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#evaluari"
                                                type="button"
                                                role="tab"
                                                aria-controls="evaluari"
                                                aria-selected="false">
                                                Evaluari Angajat
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="nav-link"
                                                id="domicilii-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#domicilii"
                                                type="button"
                                                role="tab"
                                                aria-controls="domicilii"
                                                aria-selected="false">
                                                Istoric Adrese Angajat
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <!-- mutatii angajat -->
                                        <div class="tab-pane active" id="mutatii" role="tabpanel" aria-labelledby="mutatii-tab">
                                            <div
                                                class="col-12 p-2"
                                                :class="date_fisa.date_mutatii.length > 10 ? 'col-100-vh' : ''"
                                            >
                                                <table class="table">
                                                    <thead>
                                                    <tr class="mutatii_head">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Numar Act</th>
                                                        <th scope="col">Data Aplicare Act</th>
                                                        <th scope="col">Data Emitere Act</th>
                                                        <th scope="col">Institutia</th>
                                                        <th scope="col">Tip Mutare</th>
                                                        <th scope="col">Cuprins</th>
                                                        <th scope="col">Pozitia</th>
                                                        <th scope="col">Functia</th>
                                                        <th scope="col">Coeficient</th>
                                                        <th scope="col">Suma</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr
                                                        v-for="(mutatie, index) in date_fisa.date_mutatii"
                                                        v-bind:class="[
                                                mutatie.mutatie_fel_mutatie === 0 ? 'numire' : 'mutare',
                                                mutatie.mutatie_fel_mutatie === 6 ? 'incetare' : '',
                                            ]"
                                                    >
                                                        <!-- Coloana Index -->
                                                        <td scope="col">{{ index + 1 }}</td>
                                                        <!-- Coloana Numar act -->
                                                        <td scope="col">{{ mutatie.mutatie_act_numar }}</td>
                                                        <!-- Coloana Data Aplicare -->
                                                        <td scope="col">{{ mutatie.mutatie_act_data_aplicare }}</td>
                                                        <!-- Coloana Data Emitere -->
                                                        <td scope="col">{{ mutatie.mutatie_act_data_emitere }}</td>
                                                        <!-- Coloana Denumire Institutie -->
                                                        <td class="col-institutie" scope="col">{{ mutatie.mutatie_institutie }}</td>
                                                        <td v-if="mutatie.mutatie_fel_mutatie === 5" class="text-center" scope="col">
                                                            Angajare
                                                        </td>
                                                        <td v-if="mutatie.mutatie_fel_mutatie === 6" class="text-center" scope="col">
                                                            Incetare Contract
                                                        </td>
                                                        <td v-if="mutatie.mutatie_fel_mutatie === 0" class="text-center" scope="col">
                                                            Numire
                                                        </td>
                                                        <td v-if="mutatie.mutatie_fel_mutatie === 1" class="text-center" scope="col">
                                                            Mutare
                                                        </td>
                                                        <td v-if="mutatie.mutatie_cuprins !== null" scope="col">
                                                            {{ mutatie.mutatie_cuprins }}
                                                        </td>
                                                        <td v-if="mutatie.mutatie_cuprins === null" scope="col">
                                                            {{ mutatie.mutatie_cuprins }}
                                                        </td>
                                                        <td v-if="mutatie.mutatie_pozitie" scope="col">
                                                            {{ pozitieNumarValidare(mutatie.mutatie_pozitie) }}
                                                        </td>
                                                        <td v-else scope="col"></td>
                                                        <td v-if="mutatie.mutatie_functie" scope="col">
                                                            {{ mutatie.mutatie_functie.functie_denumire }}
                                                        </td>
                                                        <td v-if="mutatie.mutatie_functie === null" scope="col"></td>
                                                        <td v-if="mutatie.mutatie_functie" scope="col">
                                                            {{ mutatie.mutatie_functie.functie_coeficient }}
                                                        </td>
                                                        <td v-if="mutatie.mutatie_functie === null" scope="col"></td>
                                                        <td v-if="mutatie.mutatie_functie" scope="col">
                                                            {{ mutatie.mutatie_functie.functie_suma }}
                                                        </td>
                                                        <td v-if="mutatie.mutatie_functie === null" scope="col"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- salarii angajat -->
                                        <div class="tab-pane" id="salarii" role="tabpanel" aria-labelledby="salarii-tab">
                                            <div
                                                class="col-12 p-2 col-table"
                                                :class="date_fisa.date_salarii.length > 15 ? 'col-100-vh' : ''"
                                            >
                                                <table class="table">
                                                    <thead>
                                                    <tr class="bg-secondary text-white">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Institutie</th>
                                                        <th scope="col">De la</th>
                                                        <th scope="col">Pana la</th>
                                                        <th scope="col">Suma initiala</th>
                                                        <th scope="col">Bonus</th>
                                                        <th scope="col">Suma Finala</th>
                                                        <th scope="col">Achitat</th>
                                                        <th scope="col">Stat / Card</th>
                                                        <th scope="col">Moneda</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(salariu, index) in date_fisa.date_salarii"
                                                            v-bind:class="salariu.salariu_achitat == 0 ? 'salariu_neachitat' : 'salariu_achitat'"
                                                            v-if="date_fisa.date_salarii != null && date_fisa.date_salarii.length > 0"
                                                        >
                                                            <th scope="row">{{ index + 1 }}</th>
                                                            <td>{{ salariu.salariu_institutie }}</td>
                                                            <td>{{ salariu.salariu_start_date }}</td>
                                                            <td>{{ salariu.salariu_end_date }}</td>
                                                            <td>{{ salariu.salariu_suma_initiala }}</td>
                                                            <td>{{ salariu.salariu_bonus }}</td>
                                                            <td>{{ salariu.salariu_suma_finala }}</td>
                                                            <td>{{ verificareAchitareSalariu(salariu.salariu_achitat) }}</td>
                                                            <td>{{ verificareTipAchitare(salariu.salariu_tip_achitare) }}</td>
                                                            <td>{{ salariu.salariu_moneda }}</td>
                                                        </tr>
                                                        <tr v-if="date_fisa.date_salarii == null || date_fisa.date_salarii.length == 0">
                                                            <td colspan="10" class="bg-warning text-center">Angajatul nu are salarii achitate.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- grafic angajat -->
                                        <div class="tab-pane" id="grafic" role="tabpanel" aria-labelledby="grafic-tab">
                                            <div class="col-12">
                                                <planet-chart :angajat-salarii="date_fisa.date_salarii"></planet-chart>
                                            </div>
                                        </div>
                                        <!-- evaluari angajat -->
                                        <div class="tab-pane" id="evaluari" role="tabpanel" aria-labelledby="evaluari-tab">
                                            <div
                                                class="col-12 p-2 col-table"
                                                :class="date_fisa.evaluari.length > 15 ? 'col-100-vh' : ''"
                                            >
                                                <table class="table">
                                                    <thead>
                                                    <tr class="bg-secondary text-white">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Institutie</th>
                                                        <th scope="col">De la</th>
                                                        <th scope="col">Pana la</th>
                                                        <th scope="col">Calificativ Initial</th>
                                                        <th scope="col">Contestatie</th>
                                                        <th scope="col">Calificativ Final</th>
                                                        <th scope="col">Stare Calificativ</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr
                                                        v-if="date_fisa.evaluari.length > 0"
                                                        v-for="(e, index) in date_fisa.evaluari"
                                                    >
                                                        <th scope="row">{{ index + 1 }}</th>
                                                        <td>{{ e.ca_institutie }}</td>
                                                        <td>{{ e.ca_data_inceput }}</td>
                                                        <td>{{ e.ca_data_sfarsit }}</td>
                                                        <td>{{ e.ca_calificativ_initial }}</td>
                                                        <td>
                                                            <span v-if="e.ca_are_contestatie == 1">Da</span>
                                                            <span v-if="e.ca_are_contestatie == 0">Nu</span>
                                                        </td>
                                                        <td>{{ e.ca_calificativ_final }}</td>
                                                        <td>
                                                            <span v-if="e.ca_status === 'Calificativ Neaprobat'" class="ca_neaprobat">Calificativ Neaprobat</span>
                                                            <span v-if="e.ca_status === 'Calificativ Aprobat'" class="ca_aprobat">Calificativ Aprobat</span>
                                                        </td>

                                                    </tr>
                                                    <tr v-if="date_fisa.evaluari.length === 0 || date_fisa.evaluari === undefined">
                                                        <td colspan="8" class="bg-no-evaluari text-center">Angajatul nu are evaluari operate.</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- adrese angajat -->
                                        <div class="tab-pane" id="domicilii" role="tabpanel" aria-labelledby="domicilii-tab">
                                            <div class="col-12 p-2 col-table">
                                                <table class="table">
                                                    <thead>
                                                    <tr class="bg-secondary">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Judet</th>
                                                        <th scope="col">Localitate</th>
                                                        <th scope="col">Strada</th>
                                                        <th scope="col">Numar</th>
                                                        <th scope="col">Bloc</th>
                                                        <th scope="col">Scara</th>
                                                        <th scope="col">Etaj</th>
                                                        <th scope="col">Apartament</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(adr, index) in lista_adrese">
                                                        <th scope="row">{{ index + 1 }}</th>
                                                        <td>{{ adr.aa_judet }}</td>
                                                        <td>{{ adr.aa_localitate }}</td>
                                                        <td>{{ adr.aa_strada }}</td>
                                                        <td>{{ adr.aa_numar }}</td>
                                                        <td>{{ adr.aa_bloc }}</td>
                                                        <td>{{ adr.aa_scara }}</td>
                                                        <td>{{ adr.aa_etaj }}</td>
                                                        <td>{{ adr.aa_apartament }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <loading-component v-if="loading === true"></loading-component>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
import LoadingComponent from "../../HelperComponents/LoadingComponent";
import PlanetChart from "../Chart/PlanetChart";
import router from "../../../router/router";

export default {
    data() {
        return {
            user_username: JSON.parse(localStorage.getItem('user')).user_username,
            user_id: JSON.parse(localStorage.getItem('user')).id,
            token: localStorage.getItem('token'),
            angajat: {
                id: this.$route.params.id
            },
            date_fisa: null,
            loading: false,
            salariiChart: null,
            lista_adrese: []
        }
    },
    created() {
        this.preluareDateAngajat();
        this.preluareAdrese();
        this.preluareRecompense();
    },
    methods: {
        async preluareAdrese(){
            this.loading = true;
            axios.get(`/api/angajati/${this.angajat.id}/adrese`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + localStorage.getItem('token')
                }
            }).then(async (response) => {
                this.lista_adrese = response.data.data
                this.loading = false;
            })
        },
        verificareTipMutatie(mutatie) {
            if (mutatie === 1) {
                return true;
            } else {
                return false;
            }
        },
        verificareAchitareSalariu(salariu) {
            if (salariu === 0) {
                return "Neachitat"
            } else if (salariu === 1) {
                return "Achitat";
            }
        },
        verificareTipAchitare(achitare) {
            if (achitare === 0) {
                return "Neachitat";
            } else if (achitare === 1) {
                return "Card";
            } else if (achitare === 2) {
                return "Stat";
            }
        },
        pozitieNumarValidare(pozitie) {
            if (pozitie < 10) {
                return `000${pozitie}`;
            } else if (pozitie > 10 & pozitie < 100) {
                return `00${pozitie}`;
            } else if (pozitie > 100 & pozitie < 1000) {
                return `0${pozitie}`
            }
        },
        async preluareDateAngajat() {
            this.loading = true;
            await axios.get(`/api/angajati/fisaevidenta/${this.angajat.id}`, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(
                response => {
                    this.date_fisa = response.data;
                    this.loading = false;
                }
            )
        },
        async preluareRecompense(){
            await axios.get(`/api/recompense/preluare/${this.angajat.id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response =>{
                this.date_fisa.recompense = response.data.data;
                this.date_fisa.recompense_angajat_preluate = true;
            });
        },
        stareCivila(stare) {
            switch (stare) {
                case 0:
                    return "Nespecificat";
                    break;
                case 1:
                    return "Necasatorit(a)";
                    break;
                case 2:
                    return "Casatorit(a)";
                    break;
                case 3:
                    return "Divortat(a)";
                    break;

            }
        },
        goToNumireAngajat(){
            router.push({ name: 'numire-angajat-selectat', params: { id: this.angajat.id } })
        },
        goToMutareAngajat(){
            router.push({ name: 'mutare-angajat-selectat', params: { id: this.angajat.id } })
        },
        goToIncetareContract(){
            router.push({ name: 'incetare-angajat-selectat', params: { id: this.angajat.id } })
        },
        goToAdaugareCalificativ(){
            router.push({ name: 'evaluare-adaugare-selectat', params: { id: this.angajat.id } })
        },
        goToAdaugareRecompense(){},
        goToAdeverintaAngajat(){
            router.push({name: 'adeverinta-angajat'});
        },
        goToAdeverintaAsigurat(){
            router.push({name: 'adeverinta-asigurat'});
        },
        goToAdeverintaSalarii(){
            router.push({name: 'adeverinta-salarii'});
        },
        prelucrareSalariiPentruChart(salarii){

        }

    },
    components: {PlanetChart, LoadingComponent, TopNav}
}
</script>

<style scoped>
.col-profile {
    display: flex;
    flex-direction: column;
}

.row-profile {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

.row-profile-template-full {
    width: 100%;
    text-align: center;
    padding: 5px;
    font-weight: bold;
    color: #04ccf6;
}

.row-profile-template {
    width: 50%;
    text-align: right;
    padding: 5px;
    font-weight: bold;
}

.row-profile-info {
    width: 50%;
    text-align: left;
    padding: 5px;
}

.col-info {
    padding: 10px;
    color: #04ccf6;
    font-weight: bold;
}

.col-table table.table {
    max-width: 100%;
    box-sizing: border-box;
}

.row-profile-template-full-flex {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.th-td-numar {
    display: flex;
    flex-direction: column;
    font-weight: normal;
    justify-items: center;
    align-items: center;
}

.table td,
.table th {
    vertical-align: middle;
    border: none;
}

/* Pentru aceasta componenta */
tr.mutare {
    font-weight: bold;
    border: 1px solid #6a89cc;
    background-color: #6a89cc;
    color: #ffffff;
}

tr.incetare {
    font-weight: bold;
    border: 1px solid #e74c3c;
    background-color: rgba(231, 76, 60, 0.7);
    color: #ffffff;
}

span.angajat-istoric-mutatii {
    background-color: #38ada9;
    color: #ffffff;
    padding: 8px;
    border-radius: 5px;
}

.col-institutie {
    text-align: center;
}

tr.mutatii_head {
    background-color: #38ada9;
    color: #ffffff;
    font-weight: bold;
}

tr.salariu_neachitat {
    color: #e71e1e;
}

tr.salariu_achitat {
    color: #38ada9;
}

.ca_neaprobat,
.ca_aprobat{
    display: inline-block;
    padding: 6px;
    border-radius: 3px;
    background-color: #ff7675;
    color: #fff;
    font-weight: bolder;
    width: 150px;
    text-align: center;
}
.ca_neaprobat{
    background-color: #ff7675;
}
.ca_aprobat{
    background-color: #55efc4;
}

.bg-no-evaluari{
    background-color: #feca57;
}
.col-100-vh{
    min-height: 100vh;
}
tr.bg-secondary{
    color: #fff;
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
.btn-disabled{
    background-color: #e74c3c;
    border: none;
    outline: none;
}
</style>
