<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-primary p-2 text-white">Lista judete</div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Regiune</th>
                        <th>Judet</th>
                        <th>Data Creare</th>
                        <th>Status</th>
                        <th>Localitati</th>
                        <th>Actiune</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="judet in judeteData">
                        <th>{{ judet.id }}</th>
                        <td>{{ judet.regiuni.denumire }}</td>
                        <td>{{ judet.denumire }}</td>
                        <td>{{ judet.data_creare }}</td>
                        <td>{{ judet.stare }}</td>
                        <td>{{ 0 }}</td>
                        <td><button class="btn btn-sm btn-danger">Suspenda Judetul</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['judete-data'],

}
</script>

<style scoped>

</style>
