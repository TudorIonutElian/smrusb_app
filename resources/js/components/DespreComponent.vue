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
                                Orice clasă de tip model conține conform documentației oficiale Laravel, denumirea tabelului, precum și proprietăți ale acesteia sau metode, pentru relaționarea cu alte clase, respectiv tabele ale bazei de date. Metodele create în interiorul claselor de tip model, ce fac legătura dintre tabel și obiect, permit relaționarea ușoara de tip inner join, fără a scrie interogări foarte lungi și greu de optimizat, permițând returnarea datelor din legătura ca proprietăți ale obiectului (exemplu Angajat->institutie_curenta).
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi cumque fuga, ipsam odio soluta temporibus? Animi assumenda consectetur cum ea excepturi fuga, fugiat neque velit vero! Alias aliquam aperiam beatae cum dignissimos dolore error harum, illo illum ipsa iure laudantium libero, maxime nobis nulla perferendis, quos rerum sapiente velit veniam!</div>
                            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
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
