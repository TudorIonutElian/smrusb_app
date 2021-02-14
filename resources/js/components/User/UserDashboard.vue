<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 d-flex mb-2">
                        <input class="form-control me-2" type="search" placeholder="Introduceti numele angajatului ..." aria-label="Search">
                        <button class="btn btn-outline-success ml-1" type="submit">Cauta</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr class="bg-success text-white">
                                <th scope="col">#</th>
                                <th scope="col">Nume</th>
                                <th scope="col">Tata</th>
                                <th scope="col">Prenume</th>
                                <th scope="col">Gradul</th>
                                <th scope="col">CNP</th>
                                <th scope="col">Ordonator</th>
                                <th scope="col">Institutia</th>
                                <th scope="col">Functia</th>
                                <th scope="col">Mergi la ...</th>
                            </tr>
                            </thead>
                            <tbody class="angajati">
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td><a href="/" class="btn btn-sm btn-secondary btn-show">Vezi Angajat</a></td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td><a :href="'/angajati/id'" class="btn btn-sm btn-secondary btn-show">Vezi Angajat</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
import UserPannel from "../Panels/UserPannel";

export default {
    data(){
        return{
            adminData:{
                email: JSON.parse(localStorage.getItem('user')).email
            }
        }
    },
    components:{
        UserPannel,
        TopNav
    },
    methods:{

    }
}
</script>

<style scoped>
.btn-show{
    border: none;
}
.btn-show:hover{
    color: #ffffff;
    background-color: #38c172;
    border: none;
}
</style>
