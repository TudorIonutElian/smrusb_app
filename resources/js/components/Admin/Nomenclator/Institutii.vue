<template>
    <div class="container-fluid">
        <top-nav
            :este-administrator="isAdmin"
            :utilizatori-inactivi="utilizatoriInactivi || 0"
        ></top-nav>
        <div v-if="isAdmin === true || isAdmin === 'true'" class="container-fluid pt-4">
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table text-center">
                        <thead>
                        <tr class="bg-success-head-row">
                            <th scope="col">#</th>
                            <th scope="col">Minister</th>
                            <th scope="col">Institutie</th>
                            <th scope="col">Cod Acces</th>
                            <th scope="col">Numar Angajati</th>
                            <th scope="col">Institutie superioara</th>
                            <th scope="col">Stare</th>
                            <th scope="col">Actiune</th>
                        </tr>
                        </thead>
                        <tbody class="angajati">
                        <tr
                            v-for="(i, index) in institutii"
                            :key="i.institutie_id"
                            :class="i.institutie_stare == 0 ? 'institutie_suspendata': '' "
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ i.institutie_minister }}</td>
                            <td>{{ i.institutie_denumire }}</td>
                            <td>{{ i.institutie_cod_acces }}</td>
                            <td>{{ i.institutie_numar_angajati }}</td>
                            <td>{{ i.institutie_ordonator_id }}</td>
                            <td>
                                <span v-if="i.institutie_stare == 0" class="institutie_inactiva">Suspendata</span>
                                <span v-if="i.institutie_stare == 1" class="institutie_activa">Activa</span>
                            </td>
                            <td>
                                <span v-if="i.institutie_stare == 0">
                                    <button
                                        class="btn btn-outline-success btn-sm"
                                        @click.prevent="activeazaInstitutie(i.institutie_id)"
                                    >
                                        Activeaza Institutie
                                    </button>
                                </span>
                                <span v-if="i.institutie_stare == 1">
                                    <button
                                        class="btn btn-outline-danger btn-sm"
                                        @click.prevent="suspendaInstitutie(i.institutie_id)"
                                    >
                                        Suspenda Institutie
                                    </button>
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
    </div>
</template>

<script>
import TopNav from '../../Menus/TopNav';
import NoAcces from '../NoAcces';

export default {
    data() {
        return {
            isAdmin: localStorage.getItem('isAdmin'),
            token: localStorage.getItem('token'),
            institutii: [],
        }
    },
    created() {
        this.preluareInstitutii();
    },
    methods: {
        async preluareInstitutii() {
            await axios.get('/api/admin/nomenclator/institutii', {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                this.institutii = response.data.data
            })
        },
        async suspendaInstitutie(id) {
            await axios.post('/api/admin/nomenclator/institutie/suspenda', {
                institutie_id: id
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                Vue.$toast.open({
                    message: 'Institutia a fost suspendata',
                    type: 'error',
                    // all of other options may go here
                });
                this.preluareInstitutii();
            })
        },
        async activeazaInstitutie(id) {
            await axios.post('/api/admin/nomenclator/institutie/activeaza', {
                institutie_id: id
            }, {
                headers: {
                    ContentType: 'application/json',
                    Authorization: 'Bearer ' + this.token
                }
            }).then(response => {
                Vue.$toast.open({
                    message: 'Institutia a fost activata',
                    type: 'success',
                    // all of other options may go here
                });
                this.preluareInstitutii();
            })
        },
    },
    components: {
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

.institutie_activa{
    color: #1dd1a1;
    font-weight: bolder;
}

.institutie_inactiva{
    color: #ee5253;
    font-weight: bolder;
}
.institutie_suspendata{
    color: #ee5253;
}

</style>
