<template>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Acasa</a>
            </li>
            <li class="nav-item dropdown" v-if="user != null && user.user_type === 3">
                <a class="nav-link dropdown-toggle" href="#" id="angajat_pontaj" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Pontaj
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/user/angajat/pontaj/creare">Adauga Pontaj</a></li>
                    <li><a class="dropdown-item" href="/user/angajat/pontaj/modificare">Modifica Pontaj</a></li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data(){
        return {

        }
    }
}
</script>

<style scoped>

</style>
