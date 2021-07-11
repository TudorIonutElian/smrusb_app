<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container-fluid mt-4 container-angajati">
                <div class="row">
                    <div class="col-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Roluri</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Facilitati</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Demo</button>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                Aplicatia Web reprezinta un Sistem Informatic dezvoltat de Tudor Ionut Elian in cadrul lucrarii de licenta din cadrul Facultatii de Cibernetic, Statistica si Informatica Economica.
                                Sistemul informatic este cuprins din codul sursă, baza de date precum și resursele web alocate acestuia, respectiv imagini și alte fișiere. Este dezvoltat pe arhitectura orientată obiect, iar fiecare tabel existent în baza de date destinată va avea o clasă PHP alocată, sub denumirea de Model (de exemplu tabelul angajați are modelul definit în clasa Angajat.php).
                                Orice clasă de tip model conține conform documentației oficiale Laravel, denumirea tabelului, precum și proprietăți ale acesteia sau metode, pentru relaționarea cu alte clase, respectiv tabele ale bazei de date. Metodele create în interiorul claselor de tip model, ce fac legătura dintre tabel și obiect, permit relaționarea ușoara de tip inner join, fără a scrie interogări foarte lungi și greu de optimizat, permițând returnarea datelor din legătura ca proprietăți ale obiectului (exemplu Angajat->institutie_curenta).php
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div>1. Administrator</div>
                                <div>2. Specialist Resurse Umane</div>
                                <div>3. Angajat</div>
                            </div>
                            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Angajati
                                                </h5>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    <span>Adaugare angajati</span>
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    <span>Numire Angajati</span>
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Mutare angajati
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Incetare contract angajati
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Evaluare
                                                </h5>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare Evaluare angajati
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Adaugare Evaluare angajati
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Aprobare Evaluare angajati
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare contestatii angajati
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare & Adaugare recompense angajati
                                                </div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare & Adaugare sanctiuni angajati
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Stat de Organizare
                                                </h5>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare Stat de Organizare</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Suplimentare Stat de Organizare</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Radiere pozitii</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare posturi vacante</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Adaugare cuprins</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Salarii
                                                </h5>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Generare Salarii</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare salarii</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Situatii Statistice
                                                </h5>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie incetari contracte</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie mutari de personal</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie Salarii Lunare</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie Salarii Trimestriale</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie Salarii Semestriale</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie Salarii Anuale</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie CASS Achitat</div>
                                                <div>
                                                    <img class="m-1" src="/images/verificat.png" alt="">
                                                    Situatie CASS Neachitat</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Pontaj
                                                </h5>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Aprobare pontaj</div>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Vizualizare pontaj</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Documente
                                                </h5>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Adeverinta angajat</div>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Adeverinta asigurat</div>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Adeverinta salarii</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title bg-primary text-white text-center p-2">
                                                    Modul Panou Control
                                                </h5>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Schimbare parola</div>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Solicitare acces</div>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Aprobare cont angajat</div>
                                                <div>
                                                     <img class="m-1" src="/images/verificat.png" alt="">
                                                    Aprobare pontaj</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import TopNav from "./Menus/TopNav";

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
        }
    },
    components:{
        TopNav,
    },
    methods:{

    }
}
</script>

<style scoped>
</style>
