<template>
    <div class="row" v-if="user.user_type === 0">
        <div class="col-12 d-flex mb-2">
            <input
                class="form-control me-2"
                type="search"
                placeholder="Introduceti numele angajatului ..."
                aria-label="Search"
                v-model="search_value"
                @keyup="sendSearchValue"
            >
            <button
                class="btn btn-outline-danger ml-1"
                type="submit"
                @click.prevent="sendResetEvent"
            >Reseteaza
            </button>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";

export default {
    data(){
        return{
            user: JSON.parse(localStorage.getItem('user')),
            search_value: ""
        }
    },
    methods:{
        sendSearchValue(){
            this.$emit('searched', this.search_value);
        },
        sendResetEvent(){
            this.search_value = 'reseted';
            this.$emit('resetedClick', this.search_value);
        }
    }
}
</script>

<style scoped>

</style>
