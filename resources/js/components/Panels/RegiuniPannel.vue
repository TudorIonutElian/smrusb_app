<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-primary p-2 text-white">Regiunile Sistemului Informatic</div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Denumire</th>
                        <th>Data Creare</th>
                        <th>Status</th>
                        <th>Judete</th>
                        <th>Actiune</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="regiune in this.regiuniData">
                        <th>{{ regiune.id }}</th>
                        <td>{{ regiune.denumire }}</td>
                        <td>{{ regiune.data_creare }}</td>
                        <td>{{ regiune.stare }}</td>
                        <td>{{ regiune.judete_count }}</td>
                        <td><button class="btn btn-sm btn-danger">Suspenda Regiunea</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import AlertaAdmin from "../Alerte/AlertaAdmin";
export default {
    components: {AlertaAdmin},
    props: ['regiuni-data'],

}
</script>

<style scoped>

</style>
