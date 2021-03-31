<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="container-fluid mt-2 p-1">
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
                            <img class="mr-2" src="/images/user.png" alt="">
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
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_prenume }} </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">CNP</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_cnp }}</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Data nasterii</div>
                        <div class="row-profile-info"> {{ date_fisa.date_personale.angajat_data_nasterii }} </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nascut in judetul: </div>
                        <div class="row-profile-info"> Popescu</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nascut in localitatea: </div>
                        <div class="row-profile-info"> Popescu</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nume anterior</div>
                        <div class="row-profile-info"> Popescu</div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Stare civila</div>
                        <div class="row-profile-info"> Casatorit </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Nivel Acces</div>
                        <div class="row-profile-info"> Agentia Nationala de Administrare Fiscala </div>
                    </div>
                    <div class="row-profile">
                        <div class="row-profile-template">Email</div>
                        <div class="row-profile-info">popescuadrian@gmail.com</div>
                    </div>
                    <div class="row-profile my-4">
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
                <div class="col-10 p-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-info p-2">
                                <span class="angajat-istoric-mutatii">Istoric Mutatii Profesionale</span>
                            </div>
                            <div class="col-12 p-2">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Institutia</th>
                                        <th scope="col">Tip Mutare</th>
                                        <th scope="col">Cuprins</th>
                                        <th scope="col">Pozitia</th>
                                        <th scope="col">Functia</th>
                                        <th scope="col">Coeficient</th>
                                        <th scope="col">Suma</th>
                                        <th scope="col">Numar Act</th>
                                        <th scope="col">Data Emitere Act</th>
                                        <th scope="col">Data Aplicare Act</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="mutare">
                                            <td scope="col" class="col-institutie">Agentia Nationala de Administrare Fiscala</td>
                                            <td scope="col" colspan="6" class="text-center">La cerere</td>
                                            <td scope="col">1234</td>
                                            <td scope="col">01.07.2000</td>
                                            <td scope="col">30.06.2000</td>
                                        </tr>
                                        <tr class="numire">
                                            <td scope="col" class="col-institutie" rowspan="3">Agentia Nationala de Administrare Fiscala</td>
                                            <td scope="col"></td>
                                            <td scope="col">I-Conducerea</td>
                                            <td scope="col">0001</td>
                                            <td scope="col">Director General</td>
                                            <td scope="col">2.80</td>
                                            <td scope="col">8000</td>
                                            <td scope="col">1234</td>
                                            <td scope="col">01.07.2000</td>
                                            <td scope="col">30.06.2000</td>
                                        </tr>
                                        <tr class="numire">
                                            <td scope="col"></td>
                                            <td scope="col">I-Conducerea</td>
                                            <td scope="col">0002</td>
                                            <td scope="col">Director General adjunct</td>
                                            <td scope="col">2.78</td>
                                            <td scope="col">8000</td>
                                            <td scope="col">1234</td>
                                            <td scope="col">01.07.2003</td>
                                            <td scope="col">30.06.2003</td>
                                        </tr>
                                        <tr class="numire">
                                            <td scope="col"></td>
                                            <td scope="col">I-Conducerea</td>
                                            <td scope="col">0002</td>
                                            <td scope="col">Director General adjunct</td>
                                            <td scope="col">2.78</td>
                                            <td scope="col">8000</td>
                                            <td scope="col">1234</td>
                                            <td scope="col">01.07.2003</td>
                                            <td scope="col">30.06.2003</td>
                                        </tr>
                                        <tr class="mutare">
                                            <td scope="col" class="col-institutie">Agentia Judeteana de Administrare Fiscala Dolj</td>
                                            <td scope="col" colspan="6" class="text-center">In interesul serviciului</td>
                                            <td scope="col">1234</td>
                                            <td scope="col">01.07.2005</td>
                                            <td scope="col">30.06.2005</td>

                                        </tr>
                                        <tr class="numire">
                                            <td scope="col" class="col-institutie" rowspan="1">Agentia Judeteana de Administrare Fiscala Dolj</td>
                                            <td scope="col"></td>
                                            <td scope="col">I-Conducerea</td>
                                            <td scope="col">0002</td>
                                            <td scope="col">Director</td>
                                            <td scope="col">2.78</td>
                                            <td scope="col">8000</td>
                                            <td scope="col">1234</td>
                                            <td scope="col">01.07.2005</td>
                                            <td scope="col">30.06.2005</td>
                                        </tr>
                                        <tr class="numire">
                                            <td scope="col"></td>
                                            <td scope="col"></td>
                                            <td scope="col">II-DRU</td>
                                            <td scope="col">0005</td>
                                            <td scope="col">Director</td>
                                            <td scope="col">2.78</td>
                                            <td scope="col">8000</td>
                                            <td scope="col">1234</td>
                                            <td scope="col">01.07.2005</td>
                                            <td scope="col">30.06.2005</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-12 col-info p-2">
                                    <span class="angajat-istoric-mutatii">Istoric Salarii Angajat</span>
                                </div>
                                <div class="col-12 p-2 col-table">
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
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Agentia Nationala de Administrare Fiscala</td>
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
                        <div class="row">
                            <div class="col-12 col-info p-2">
                                <span class="angajat-istoric-mutatii">Istoric Domiciliu Angajat</span>
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
    </div>
</template>

<script>
import TopNav from "../../Menus/TopNav";
export default {
    data(){
        return{
            user_username: JSON.parse(localStorage.getItem('user')).user_username,
            user_id: JSON.parse(localStorage.getItem('user')).id,
            token: localStorage.getItem('token'),
            angajat:{
                id: this.$route.params.id
            },
            date_fisa: null
        }
    },
    created(){
        this.preluareDateAngajat();
    },
    methods:{
        async preluareDateAngajat(){
            await axios.get(`/api/angajati/fisaevidenta/${this.angajat.id}`, {
                headers:{
                    ContentType: 'application/json',
                    Authorization : 'Bearer ' + this.token
                }
            }).then(
                response=>{
                    this.date_fisa = response.data;
                }
            )
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
.row-profile-template-full-flex{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.th-td-numar{
    display: flex;
    flex-direction: column;
    font-weight: normal;
    justify-items: center;
    align-items: center;
}
.table td,
.table th{
    vertical-align: middle;
    border: none;
}
/* Pentru aceasta componenta */
tr.mutare{
    font-weight: bold;
    border: 1px solid #6a89cc;
    color: #6a89cc;
}
span.angajat-istoric-mutatii{
    background-color: #38ada9;
    color: #ffffff;
    padding: 10px;
    border-radius: 5px;
}
.col-institutie{
    text-align: center;
}
</style>
