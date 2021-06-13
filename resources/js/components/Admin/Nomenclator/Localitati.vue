<template>
    <div class="container-fluid">
        <top-nav
            :este-administrator="isAdmin"
            :utilizatori-inactivi="utilizatoriInactivi"
        ></top-nav>
        <div v-if="isAdmin === true || isAdmin === 'true'" class="container pt-4">
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table text-center">
                        <thead>
                        <tr class="bg-success-head-row">
                            <th scope="col">#</th>
                            <th scope="col">Localitate</th>
                            <th scope="col">Mediul</th>
                            <th scope="col">Resedinta</th>
                            <th scope="col">Stare</th>
                            <th scope="col">Actiune</th>
                        </tr>
                        </thead>
                        <tbody class="angajati">
                            <tr v-for="(l, index) in localitati" :key="l.localitate_id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ l.localitate_denumire }}</td>
                                <td>
                                    <span v-if="l.localitate_mediul === 0" class="mediu_rural">Rural</span>
                                    <span v-if="l.localitate_mediul === 1" class="mediu_urban">Urban</span>
                                </td>
                                <td>
                                    <span v-if="l.localitate_resedinta === 0" class="mediu_rural">Nu</span>
                                    <span v-if="l.localitate_resedinta === 1" class="mediu_urban">Da</span>
                                </td>
                                <td>
                                    <span v-if="l.localitate_stare === 1" class="localitate_activa">Activa</span>
                                    <span v-if="l.localitate_stare === 0" class="localitate_inactiva">Inactiva</span>
                                </td>
                                <td>
                                    <span v-if="l.localitate_stare === 1">
                                        <button class="btn btn-outline-danger btn-sm" @click="suspendaLocalitate(l.localitate_id)">Suspenda</button>
                                    </span>
                                    <span v-if="l.localitate_stare === 0">
                                        <button class="btn btn-outline-success btn-sm" @click="activeazaLocalitate(l.localitate_id)">Activeaza</button>
                                    </span>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div v-else class="container">
            <no-acces></no-acces>
        </div>
        <div class="row" v-if="loading === true">
            <loading-component></loading-component>
        </div>
    </div>
</template>

<script>
import TopNav from '../../Menus/TopNav';
import NoAcces from '../NoAcces';
import LoadingComponent from "../../HelperComponents/LoadingComponent";

export default {
    data() {
        return {
            isAdmin: localStorage.getItem('isAdmin'),
            utilizatoriInactivi: [],
            token: localStorage.getItem('token'),
            localitati: [],
            loading: false
        }
    },
    created() {
        this.preluareLocalitati();
    },
    methods: {
        async preluareLocalitati() {
            this.loading = true;
            await axios.get('/api/admin/nomenclator/localitati', {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                this.localitati = response.data.data;
                this.loading = false;
            })
        },
        async suspendaLocalitate(id) {
            this.loading = true;
            await axios.post('/api/admin/nomenclator/localitate/suspenda', {
                localitate_id: id
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                Vue.$toast.open({
                    message: 'Localitatea a fost suspendata',
                    type: 'error',
                    // all of other options may go here
                });
                this.preluareLocalitati();
            })
        },
        async activeazaLocalitate(id) {
            await axios.post('/api/admin/nomenclator/localitate/activeaza', {
                localitate_id: id
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                Vue.$toast.open({
                    message: 'Localitatea a fost activata',
                    type: 'success',
                    // all of other options may go here
                });
                this.preluareLocalitati();
            })
        }
    },
    components: {
        LoadingComponent,
        TopNav,
        NoAcces
    }
}
</script>

<style scoped>
tr:hover{
    background-color: #c8d6e5;
}
tr:hover > td button.btn-outline-danger{
    background-color: #ee5253;
    color: #ffffff;
}
tr:hover > td button.btn-outline-success{
    background-color: #1dd1a1;
    color: #ffffff;
}

.judet_activ{
    color: #1dd1a1;
    font-weight: bolder;
}

.judet_inactiv{
    color: #ee5253;
    font-weight: bolder;
}
.mediu_rural{
    padding: 5px;
    background-color: #00cec9;
    color: #fff;
    border-radius: 5px;
}
.mediu_urban{
    background-color: #e84393;
    padding: 5px;
    color: #fff;
    border-radius: 5px;
}

.localitate_activa{
    color: #1dd1a1;
    font-weight: bolder;
}

.localitate_inactiva{
    color: #ee5253;
    font-weight: bolder;
}

</style>
