<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="container-fluid mt-2 p-1">
            <div class="row">
                <div class="col-12 bg-primary-blue p-2 text-center">
                    Dosar Angajat
                </div>
            </div>
            <!-- row profil utilizator -->
            <div class="row mt-2">
                <div class="col-3 col-profile">
                    <div class="row-profile">
                        <div class="row-profile-template-full p-2">Date personale angajat</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nume</div>
                        <div class="row-profile-info"> {{ this.user_data.user_first_name}}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Prenume</div>
                        <div class="row-profile-info">{{ this.user_data.user_last_name}}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Email</div>
                        <div class="row-profile-info">{{ this.user_data.user_email}}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Username</div>
                        <div class="row-profile-info">{{ this.user_data.user_username}}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Rol</div>
                        <div class="row-profile-info">{{ this.user_data.user_type === 1 ? 'Administrator': 'Angajat Resurse Umane'}}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Administrator</div>
                        <div class="row-profile-info">{{ this.user_data.user_is_admin === 1 ? 'DA': 'NU'}}</div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-info p-2">
                                Istoric angajat
                            </div>
                            <div class="col-12 p-2">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Utilizator</th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Detalii</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(istoric, index) in this.user_history" :key="index">
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ user_username }}</td>
                                        <td>{{ istoric.iu_data}}</td>
                                        <td>{{ istoric.iu_detalii}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row nivel de acces -->
            <div class="row mt-4">
                <div class="col-3 col-profile">
                    <div class="row-profile">
                        <div class="row-profile-template-full p-2">Salarii Angajat</div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-info p-2">
                                Salarii Angajat
                            </div>
                            <div class="col-12 p-2">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Institutie</th>
                                        <th scope="col">De la </th>
                                        <th scope="col">Pana la </th>
                                        <th scope="col">Suma bruta </th>
                                        <th scope="col">CAS </th>
                                        <th scope="col">Impozit </th>
                                        <th scope="col">Suma neta </th>
                                        <th scope="col">Achitat</th>
                                        <th scope="col">Stat / Card </th>
                                        <th scope="col">Moneda </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(acces, index) in user_acces" :key="index">
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ acces.ua_denumire}}</td>
                                            <td>2021-01-01</td>
                                            <td>2021-01-31</td>
                                            <td>10.000</td>
                                            <td>800</td>
                                            <td>1350</td>
                                            <td>7850</td>
                                            <td>DA</td>
                                            <td>Card</td>
                                            <td>RON</td>
                                        </tr>
                                        <tr v-for="(acces, index) in user_acces" :key="index">
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ acces.ua_denumire}}</td>
                                            <td>2021-01-01</td>
                                            <td>2021-01-31</td>
                                            <td>10.000</td>
                                            <td>800</td>
                                            <td>1350</td>
                                            <td>7850</td>
                                            <td>DA</td>
                                            <td>Card</td>
                                            <td>RON</td>
                                        </tr>
                                        <tr v-for="(acces, index) in user_acces" :key="index">
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ acces.ua_denumire}}</td>
                                            <td>2021-01-01</td>
                                            <td>2021-01-31</td>
                                            <td>10.000</td>
                                            <td>800</td>
                                            <td>1350</td>
                                            <td>7850</td>
                                            <td>DA</td>
                                            <td>Card</td>
                                            <td>RON</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row profil adresa -->
            <div class="row mt-4">
                <div class="col-3 col-profile">
                    <div class="row-profile">
                        <div class="row-profile-template-full p-2">Adresa angajat</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Judet</div>
                        <div class="row-profile-info"> - </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Localitate</div>
                        <div class="row-profile-info"> - </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Strada</div>
                        <div class="row-profile-info">-</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Numar</div>
                        <div class="row-profile-info"> - </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Bloc</div>
                        <div class="row-profile-info"> - </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Scara</div>
                        <div class="row-profile-info"> - </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Etaj</div>
                        <div class="row-profile-info"> - </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Apartament</div>
                        <div class="row-profile-info"> - </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-info p-2">
                                Istoric adrese angajat
                            </div>
                            <div class="col-12 p-2 col-table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judet</th>
                                        <th scope="col">Localitate</th>
                                        <th scope="col">Strada</th>
                                        <th scope="col">Numar</th>
                                        <th scope="col">Bloc</th>
                                        <th scope="col">Scara</th>
                                        <th scope="col">Etaj</th>
                                        <th scope="col">Apartament</th>
                                        <th scope="col">Data Inceput</th>
                                        <th scope="col">Data Sfarsit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Bucuresti</td>
                                        <td>Sector 6</td>
                                        <td>Bulevardul Constructorilor</td>
                                        <td>24</td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>4</td>
                                        <td>7</td>
                                        <td>2020-01-01</td>
                                        <td>2020-01-01</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row nivel de acces -->
            <div class="row mt-4">
                <div class="col-3 col-profile">
                    <div class="row-profile">
                        <div class="row-profile-template-full p-2">Acces Utilizator</div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-info p-2">
                                Istoric mutari si numiri angajat
                            </div>
                            <div class="col-12 p-2">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Institutie</th>
                                        <th scope="col">De la </th>
                                        <th scope="col">Pana la </th>
                                        <th scope="col">Activ </th>
                                        <th scope="col">Anuleaza </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(acces, index) in user_acces" :key="index">
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ acces.ua_denumire}}</td>
                                        <td>{{ acces.ua_start_date }}</td>
                                        <td>{{ acces.ua_end_date ? acces.ua_end_date : 'Prezent' }}</td>
                                        <td>{{ acces.ua_end_date ? 'NU' : 'DA' }}</td>
                                        <td><button class="btn btn-outline-danger btn-sm">Anuleaza</button></td>
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
</template>

<script>
import TopNav from "../../Menus/TopNav";
export default {
    data(){
        return{
            user_username: JSON.parse(localStorage.getItem('user')).user_username,
            user_id: JSON.parse(localStorage.getItem('user')).id,
            user_token: localStorage.getItem('token'),
            user_acces: [],
            user_history: [],
            user_data: null
        }
    },
    created(){
        this.get_user_data();
    },
    methods:{
        async get_user_data(){
            await axios.get(`/api/users/pannel/${this.user_id}`,{
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.user_token
                }
            }).then(response=>{
                console.log(response)
                this.user_data         = response.data.user_data;
                this.user_acces         = response.data.user_acces;
                this.user_history       = response.data.user_history;
            })
        }
    },
    components: {TopNav}
}
</script>

<style scoped>
.col-profile{
    display: flex;
    flex-direction: column;
}
.row-profile{
    display: flex;
    flex-direction: row;
    justify-content: space-around;

}
.row-profile-template-full{
    width: 100%;
    text-align: center;
    padding: 5px;
    font-weight: bold;
    color: #04ccf6;
}
.row-profile-template{
    width: 50%;
    text-align: right;
    padding: 5px;
    font-weight: bold;
}
.row-profile-info{
    width: 50%;
    text-align: left;
    padding: 5px;
}
.col-info{
    padding: 10px;
    color: #04ccf6;
    font-weight: bold;
}
.col-table table.table{
    max-width: 100%;
    box-sizing: border-box;
}
</style>
