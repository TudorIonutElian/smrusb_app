<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div v-if="loading == false" class="row">
            <div class="container mt-4 container-angajati">
                <div class="row">
                    <div class="col-12 mt-3 mb-4">
                        <span class="recompense-badge">Adaugare sanctiuni angajati</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <select
                            v-model="institutie_selectata"
                            aria-label="Default select example"
                            class="form-select form-control"
                            @change="preluareAngajatiByInstitutie"
                        >
                            <option v-for="i in acces_user_institutii" :value="i.id">{{ i.institutie_denumire }}
                            </option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select
                            v-model="angajat_selectat"
                            :disabled="institutie_selectata == 0"
                            aria-label="Default select example"
                            class="form-select form-control"
                            @change="preluareSanctiuni"
                        >
                            <option v-for="a in lista_angajati" :value="a.id">{{ a.angajat_nume }} {{
                                    a.angajat_prenume
                                }}
                            </option>
                        </select>
                    </div>
                    <div class="col-4">
                        <button
                            :disabled="institutie_selectata == 0"
                            class="btn btn-outline-success btn-block"
                            @click.prevent="salvareSanctiuneNoua"
                        >Adaugare Sanctiune
                        </button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <select
                            v-model="sanctiune_selectat"
                            :disabled="angajat_selectat == 0"
                            aria-label="Default select example"
                            class="form-select form-control"
                        >
                            <option v-for="s in lista_sanctiuni" :value="s.id">{{ s.ds_denumire }}</option>
                        </select>
                    </div>
                </div>
                <div v-if="lista_sanctiuni_angajat_preluate == true && lista_sanctiuni_angajat.length > 0" class="row mt-3">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Recompensa</th>
                                <th scope="col">Data acordarii</th>
                                <th scope="col">Data expirarii</th>
                                <th scope="col">Status</th>
                                <th scope="col">Radiere Automata</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-if="lista_sanctiuni_angajat_preluate == true && lista_sanctiuni_angajat.length > 0"
                                    v-for="(ls, index) in lista_sanctiuni_angajat">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ ls.denumire }}</td>
                                    <td>{{ ls.data_acordarii }}</td>
                                    <td>{{ ls.data_expirarii }}</td>
                                    <td>
                                        <span v-if="ls.status == 1" class="sanctiune-activa">Activa</span>
                                        <span v-if="ls.status == 0" class="sanctiune-inactiva">Radiata</span>
                                    </td>
                                    <td>
                                        <span v-if="isNaN(ls.radiere_in) ">{{ ls.radiere_in }}</span>
                                        <span v-if="!isNaN(ls.radiere_in) ">{{ ls.radiere_in }} zile</span>
                                    </td>
                                </tr>
                                <tr v-if="lista_sanctiuni_angajat_preluate == true && lista_sanctiuni_angajat.length == 0">
                                    <td colspan="4" class="text-white, text-center bg-warning text-bold">Angajatul nu are sanctiuni implementate.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="loading == true" class="row">
            <loading-component></loading-component>
        </div>
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
import LoadingComponent from "../../HelperComponents/LoadingComponent";

export default {
    data() {
        return {
            user: JSON.parse(localStorage.getItem('user')),
            token: localStorage.getItem('token'),
            acces_user_institutii: [],
            lista_angajati: [],
            lista_sanctiuni: [],
            lista_sanctiuni_angajat: [],
            institutie_selectata: 0,
            lista_sanctiuni_angajat_preluate: false,
            angajat_selectat: 0,
            sanctiune_selectat: 0,
            loading: false
        }
    },
    created() {
        this.preluareUserAcces();
    },
    components: {
        LoadingComponent,
        TopNav,
    },
    methods: {
        async preluareUserAcces() {
            await axios.get(`/api/users/institutii/acces/${this.user.id}`, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                this.acces_user_institutii = response.data
            })
        },
        async preluareAngajatiByInstitutie() {
            await axios.get(`/api/angajati/preluare_angajati_institutie/${this.institutie_selectata}`, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                this.lista_angajati = response.data
            })
        },
        async preluareSanctiuni() {
            await axios.get('/api/sanctiuni/preluare', {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token,
                }
            }).then(response => {
                this.lista_sanctiuni = response.data;
            });

            await axios.get(`/api/sanctiuni/preluare/${this.angajat_selectat}`, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                this.lista_sanctiuni_angajat = response.data.data;
                this.lista_sanctiuni_angajat_preluate = true;
            });


        },
        async salvareSanctiuneNoua() {
            await axios.post(`/api/sanctiuni/adaugare`, {
                s_angajat_id    : this.angajat_selectat,
                s_sanctiune_id  : this.sanctiune_selectat
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then((response) => {
                if (response.data.return_message == 1000) {
                    Vue.$toast.open({
                        message: 'Sanctiunea a fost adaugata!',
                        type: 'success',
                        // all of other options may go here
                    });
                    this.$router.go();
                }
            })
        }


    },

}
</script>

<style scoped>
.recompense-badge {
    background-color: #e74c3c;
    padding: 10px;
    border-radius: 4px;
    font-weight: bold;
    color: #fff;
}

button.btn-outline-success {
    background-color: #e74c3c !important;
    font-weight: bold;
    color: #fff;
    border: none;
    outline: none;
}
.sanctiune-activa{
    padding: 8px;
    border-radius: 3px;
    background-color: #2ecc71;
    font-weight: bold;
    color: #fff;
}

.sanctiune-inactiva{
    padding: 8px;
    border-radius: 3px;
    background-color: #e74c3c;
    font-weight: bold;
    color: #fff;
}
</style>
