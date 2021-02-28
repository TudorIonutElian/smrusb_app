<template>
    <div class="alerta-success">
        Operatiune Ok
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    }
}
</script>

<style scoped>
.alerta-success{
    position: fixed;
    width: 200px;
    padding: 15px;
    background-color: #2ecc71;
    bottom: 3%;
    right: 3%;
    color: #ffffff;
    border-radius: 5%;
    text-align: center;
    animation-name: example;
    animation-duration: 0.5s;
    cursor: pointer;
}

@keyframes example {
    0%{
        opacity: .9;
        display: block;
    }
    50%{
        opacity: .7;
    }
    80%{
        opacity: 0;
    }
    100%{
        display: none;
    }
}
</style>
