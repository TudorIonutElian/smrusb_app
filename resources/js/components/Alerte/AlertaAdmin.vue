<template>
    <div class="alerta-success">
        <p>{{ mesajAlerta}}</p>
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    props:['mesaj-alerta']
}
</script>

<style scoped>
.alerta-success{
    position: fixed;
    bottom: 10px;
    right: 30px;
    display: block;
    width: 200px;
    padding: 15px;
    background-color: #2ecc71;
    bottom: 3%;
    right: 3%;
    color: #ffffff;
    border-radius: 4%;
    text-align: center;
    cursor: pointer;
    animation: example 4s;
    animation-fill-mode: forwards;
}

@keyframes example {
    0%{
        opacity: .9;
        bottom: 30px;
        right: -100px;
    }
    5%{
        opacity: .9;
        bottom: 30px;
        right: -70px;
    }
    15%{
        opacity: .9;
        bottom: 30px;
        right: -10px;
    }
    25%{
        opacity: .9;
        bottom: 30px;
        right: -26px;
    }
    100%{
         opacity: .9;
         bottom: 30px;
         right: -1000px;
    }
}
</style>
