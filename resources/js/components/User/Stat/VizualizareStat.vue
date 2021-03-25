<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="row mt-4">
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 my-3">
                            <div class="input-group flex-nowrap">
                                <span id="addon-wrapping" class="input-group-text mr-2">Selectati Institutia</span>
                                <select class="form-control form-select mr-1">
                                    <option>Institutie 1</option>
                                </select>
                                <button class="btn btn-success">Vizualizare</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-2">Statul de organizare al : </div>
                        <div class="col-12 mt-3">
                            <table class="table text-center">
                                <thead>
                                <tr class="tr-flex-row">
                                    <th scope="col">Pozitie</th>
                                    <th scope="col" class="td-cuprins">Denumire Cuprins</th>
                                    <th scope="col">Denumire Functie</th>
                                    <th scope="col">Coeficient Functie</th>
                                    <th scope="col">Suma Functie</th>
                                    <th scope="col">Gradul persoanei</th>
                                    <th scope="col">Nume si prenume</th>
                                    <th scope="col">Data numirii</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">0001</th>
                                        <td class="td-cuprins">I - Conducere</td>
                                        <td >Director general</td>
                                        <td>2.88</td>
                                        <td>8.000</td>
                                        <td>-</td>
                                        <td><a href="/">Popescu Aurelian</a></td>
                                        <td>01.07.2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">0002</th>
                                        <td class="td-cuprins">I - Conducere</td>
                                        <td>Director general adjunct</td>
                                        <td>2.80</td>
                                        <td>7.500</td>
                                        <td>Gradul didactic I</td>
                                        <td><a href="/">Matei Andrei Aurelian</a></td>
                                        <td>01.07.2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">0003</th>
                                        <td class="td-cuprins">II - Departament Resurse Umane</td>
                                        <td>Director</td>
                                        <td>2.80</td>
                                        <td>7.500</td>
                                        <td>Gradul didactic I</td>
                                        <td><a href="/">Matei Andrei Aurelian</a></td>
                                        <td>01.07.2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">0004</th>
                                        <td class="td-cuprins">II - Departament Resurse Umane</td>
                                        <td>Director adjunct</td>
                                        <td>2.80</td>
                                        <td>7.500</td>
                                        <td>Gradul didactic I</td>
                                        <td><a href="/">Matei Andrei Aurelian</a></td>
                                        <td>01.07.2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">0005</th>
                                        <td class="td-cuprins">II. 1 - DRU - Serviciul Incadrare</td>
                                        <td>Sef Serviciu</td>
                                        <td>2.80</td>
                                        <td>7.500</td>
                                        <td>Gradul didactic I</td>
                                        <td><a href="/">Matei Andrei Aurelian</a></td>
                                        <td>01.07.2017</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">0005</th>
                                        <td class="td-cuprins">II. 1 - DRU - Serviciul Incadrare</td>
                                        <td>Functionar public superior</td>
                                        <td>2.80</td>
                                        <td>7.500</td>
                                        <td>-</td>
                                        <td><a href="/">Matei Andrei Aurelian</a></td>
                                        <td>01.07.2017</td>
                                    </tr>
                                    <tr class="post-liber">
                                        <th scope="row">0006</th>
                                        <td class="td-cuprins">II. 1 - DRU - Serviciul Incadrare</td>
                                        <td>Functionar public superior</td>
                                        <td>2.80</td>
                                        <td>7.500</td>
                                        <td>-</td>
                                        <td><a href="/">-</a></td>
                                        <td>-</td>
                                    </tr>
                                    <tr class="post-liber">
                                        <th scope="row">0007</th>
                                        <td class="td-cuprins">II. 1 - DRU - Serviciul Incadrare</td>
                                        <td>Functionar public superior</td>
                                        <td>2.80</td>
                                        <td>7.500</td>
                                        <td>-</td>
                                        <td><a href="/">-</a></td>
                                        <td>-</td>
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
.td-cuprins{
    text-align: right;
}
tr.post-liber{
    background-color: #f6e58d;
}
</style>
