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
                        <th>Username</th>
                        <th>Prenume</th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actiune</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="utilizator in this.utilizatoriData">
                        <th>{{ utilizator.id }}</th>
                        <td>{{ utilizator.user_username }}</td>
                        <td>{{ utilizator.user_first_name }}</td>
                        <td>{{ utilizator.user_last_name }}</td>
                        <td>{{ utilizator.user_email }}</td>
                        <td v-if="utilizator.user_is_active === 1"><span class="user-active">Cont Activ</span></td>
                        <td v-if="utilizator.user_is_active === 0"><span class="user-inactive">Cont Inactiv</span></td>

                        <td v-if="utilizator.user_is_active === 1">
                            <button class="btn btn-danger btn-sm" @click="suspendaCont(utilizator.id)">Suspenda Cont
                            </button>
                        </td>
                        <td v-if="utilizator.user_is_active === 0">
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
