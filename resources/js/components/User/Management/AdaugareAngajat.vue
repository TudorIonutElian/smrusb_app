<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4">
                <div class="row row-bordered p-2">
                    <div class="col-12 p-1 text-center">
                        Adauga Angajat Nou
                    </div>
                </div>
                <div class="row row-blue mt-2">
                    <div class="col-12 p-1">
                        <span>Date Personale</span>
                    </div>
                </div>
                <!-- Numele Angajatului-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_nume" class="form-label">Nume</label>
                        <input type="text" class="form-control" id="angajat_nume" placeholder="Numele">
                    </div>
                </div>
                <!-- Prenumele Tatalui-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_prenume_tata" class="form-label">Prenume tatal</label>
                        <input type="text" class="form-control" id="angajat_prenume_tata" placeholder="Prenumele tatalui">
                    </div>
                </div>
                <!-- Prenumele Mamei-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_prenume_mama" class="form-label">Prenume mama</label>
                        <input type="text" class="form-control" id="angajat_prenume_mama" placeholder="Prenumele mamei">
                    </div>
                </div>
                <!-- Prenumele Angajatului-->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_prenume" class="form-label">Prenume</label>
                        <input type="text" class="form-control" id="angajat_prenume" placeholder="Prenumele">
                    </div>
                </div>
                <!-- Nume anterior -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_nume_anterior" class="form-label">Numele anterior</label>
                        <input type="text" class="form-control" id="angajat_nume_anterior" placeholder="Nume anterior">
                    </div>
                </div>
                <!-- Data nasterii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_data_nastere" class="form-label">Data Nasterii</label>
                        <input type="date" class="form-control" id="angajat_data_nastere">
                    </div>
                </div>
                <!-- Starea Civila -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_starea_civila" class="form-label">Starea civila</label>
                        <select class="form-control form-select" id="angajat_starea_civila">
                            <option selected>Nespecificat</option>
                            <option value="1">Necasatorit(a)</option>
                            <option value="1">Casatorit(a)</option>
                            <option value="2">Divortat(a)</option>
                        </select>
                    </div>
                </div>
                <!-- Judetul nasterii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_judet_nastere" class="form-label">Judetul nasterii</label>
                        <select class="form-control form-select" id="angajat_judet_nastere">
                            <option selected>Arad</option>
                        </select>
                    </div>
                </div>
                <!-- Localitatea nasterii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_localitate_nastere" class="form-label">Localitatea nasterii</label>
                        <select class="form-control form-select" id="angajat_localitate_nastere">
                            <option selected>Arad</option>
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
                        <select class="form-control form-select" id="angajat_judet_domiciliu">
                            <option selected>Arad</option>
                        </select>
                    </div>
                </div>
                <!-- Localitatea nasterii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed form-group">
                        <label for="angajat_localitate_domiciliu" class="form-label">Localitatea</label>
                        <select class="form-control form-select" id="angajat_localitate_domiciliu">
                            <option selected>Arad</option>
                        </select>
                    </div>
                </div>

                <!-- Strada -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_strada_domiciliu" class="form-label">Strada</label>
                        <input type="text" class="form-control" id="angajat_strada_domiciliu" placeholder="Numele strazii">
                    </div>
                </div>
                <!-- Numarul Strazii -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_nr_domiciliu" class="form-label">Numarul</label>
                        <input type="text" class="form-control" id="angajat_nr_domiciliu" placeholder="Numarul">
                    </div>
                </div>
                <!-- Blocul -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_bloc_domiciliu" class="form-label">Bloc</label>
                        <input type="text" class="form-control" id="angajat_bloc_domiciliu" placeholder="Bloc">
                    </div>
                </div>
                <!-- Scara -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_scara_domiciliu" class="form-label">Scara</label>
                        <input type="text" class="form-control" id="angajat_scara_domiciliu" placeholder="Scara">
                    </div>
                </div>
                <!-- Etaj -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_etaj_domiciliu" class="form-label">Etaj</label>
                        <input type="text" class="form-control" id="angajat_etaj_domiciliu" placeholder="Etaj">
                    </div>
                </div>
                <!-- Apartament -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_apartament_domiciliu" class="form-label">Apartament</label>
                        <input type="text" class="form-control" id="angajat_apartament_domiciliu" placeholder="Apartament">
                    </div>
                </div>
                <!-- Numar de telefon mobil -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_mobil_domiciliu" class="form-label">Telefon mobil</label>
                        <input type="text" class="form-control" id="angajat_mobil_domiciliu" placeholder="Telefon mobil">
                    </div>
                </div>
                <!-- Numar de telefon fix -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">Telefon fix</label>
                        <input type="text" class="form-control" id="angajat_fix_domiciliu" placeholder="Telefon fix">
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

                        <input type="text" class="form-control" placeholder="Link Facebook">
                    </div>
                </div>
                <!-- Twitter Link -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">
                            <img class="mr-2" src="/images/twitter.png" alt="">
                        </label>

                        <input type="text" class="form-control" placeholder="Link Twitter">
                    </div>
                </div>
                <!-- Google Link -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">
                            <img class="mr-2" src="/images/google-plus.png" alt="">
                        </label>

                        <input type="text" class="form-control" placeholder="Link Google Plus">
                    </div>
                </div>
                <!-- Youtube Link -->
                <div class="row p-1">
                    <div class="col-12 col-12-flexed">
                        <label for="angajat_fix_domiciliu" class="form-label">
                            <img class="mr-2" src="/images/youtube.png" alt="">
                        </label>

                        <input type="text" class="form-control" placeholder="Link Youtube">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-12">
                        <button type="button" class="btn btn-adauga-angajat btn-block">
                            Adauga Angajat Nou
                        </button>
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

        }
    },
    components:{
        TopNav
    },
    methods:{

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
</style>
