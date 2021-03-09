<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-primary p-2 text-white">Utilizatorii Sistemului Informatic</div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Rol</th>
                        <th>Actiune</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="utilizator in this.utilizatoriData">
                        <th>{{ utilizator.id }}</th>
                        <td>{{ utilizator.name }}</td>
                        <td>{{ utilizator.email }}</td>
                        <td v-if="utilizator.isActive === 1"><span class="user-active">Cont Activ</span></td>
                        <td v-if="utilizator.isActive === 0"><span class="user-inactive">Cont Inactiv</span></td>

                        <td v-if="utilizator.userType=== 1"><span
                            class="admin-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                        <td v-if="utilizator.userType=== 3"><span
                            class="specialist-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                        <td v-if="utilizator.userType=== 2"><span
                            class="angajat-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                        <td v-if="utilizator.userType=== null"><span
                            class="faraRol-class">{{ checkRoleName(utilizator.userType) }}</span></td>
                        <td v-if="utilizator.isActive === 1">
                            <button class="btn btn-danger btn-sm" @click="suspendaCont(utilizator.id)">Suspenda Cont
                            </button>
                        </td>
                        <td v-if="utilizator.isActive === 0">
                            <button class="btn btn-success btn-sm" @click="activeazaCont(utilizator.id)">Activeaza Cont
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['utilizatori-data'],
    data() {
        return {
            users: null
        }
    },
    created() {
        this.token = localStorage.getItem('token');
    },
    methods: {
        getProps() {
            //console.log(this.props.utilizatoriData)
        },
        checkRoleName(role) {
            if (role === 1) {
                return 'Administrator'
            } else if (role === 2) {
                return 'Angajat'
            } else if (role === 3) {
                return 'Specialist Resurse Umane'
            } else if (role === null) {
                return 'Far rol'
            }
        },
        async suspendaCont(id){
            await axios.post('/api/users/suspenda', {
                contID : id
            },{
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                this.$emit('suspendaUtilizator')
            });
        },
        async activeazaCont(id){
            await axios.post('/api/users/activeaza', {
                contID : id
            },{
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(response=>{
                this.$emit('activeazaUtilizator')
            });
        }
    }
}
</script>

<style>

.user-active {
    padding: 7px;
    background-color: #38c172;
    color: #ffffff;
    border-radius: 5px;
}

.user-inactive {
    padding: 7px;
    background-color: #e74c3c;
    color: #ffffff;
    border-radius: 3px;
}

.admin-class {
    padding: 5px;
    color: #ffffff;
    border-radius: 5px;
    background-color: #065ef1;
}

.specialist-class {
    padding: 5px;
    color: #2be9e9;
    border-radius: 5px;
}

.angajat-class {
    padding: 5px;
    color: #039fe7;
    border-radius: 5px;
}
.faraRol-class{
    padding: 7px;
    color: #ffffff;
    background-color: #a9a4a4;
    border-radius: 5px;
}

</style>
