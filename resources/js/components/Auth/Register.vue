<template>
    <div id="registerPage">
        <top-nav></top-nav>
        <div class="container-register mt-2 p-4">
            <div id="registerArea">
                    <div class="my-4 text-white bg-success p-3 text-center">Solicitare acces la SIC SMRUSB</div>
                    <form class="form">
                        <div class="mb-3">
                            <label class="form-label">Numele si prenumele dumneavoastra</label>
                            <input type="text" class="form-control w-100">
                            <div>Va rugam sa introduceti numele dumneavoastra, asa cum apare pe contractul de munca!</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contul de Utilizator</label>
                            <input type="text" class="form-control w-100" disabled>
                            <div>Atentie, contul de utilizator nu poate fi personalizat!</div>
                        </div>
                        <select class="form-control" aria-label="Default select example">
                            <option selected>Selectati institutia la care doriti acces!</option>
                            <option value="1">Institutia 1</option>
                            <option value="1">Institutia 2</option>
                            <option value="1">Institutia 3</option>
                            <option value="1">Institutia 4</option>
                            <option value="1">Institutia 5</option>
                        </select>
                        <div class="mb-3">
                            <label class="form-label">Introduceti o parola (minim 8 caracter)</label>
                            <input type="password" class="form-control w-100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reintroduceti parola</label>
                            <input type="password" class="form-control w-100">
                        </div>
                        <button class="btn btn-outline-light btn-block mt-2">Trimite cererea</button>
                    </form>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
export default {
    data(){
        return{

        }
    },
    components: {TopNav}
}
</script>

<style scoped>
#registerPage{
    background-color: #dcdde1;
}
.container-register{
    width: 100%;
    min-height: 94.5vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.container-register #registerArea{
    padding: 60px;
    width: 40%;
    min-height: 100%;
    background-color: #487eb0;
    color: #ffffff;
    border-radius: 10px;
}
</style>
