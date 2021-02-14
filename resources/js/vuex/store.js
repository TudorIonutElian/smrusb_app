import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)


const store = new Vuex.Store({
    state: {
        isLoggedIn: false,
        isAdmin: false,
        user: null
    },
    mutations: {
        isLogged (state, payload) {
            state.isLoggedIn = payload;
        },
        isAdmin(state, payload){
            state.isAdmin = payload;
        },
        setUser(state, payload){
            state.user = payload
        },
    },
    actions:{
        setLoggedIn({commit, dispatch}, payload){
            commit('isLogged', payload);
            localStorage.setItem('isLoggedIn', payload);
        },
        setAdminLoggedIn({commit, dispatch}, payload){
            commit('isAdmin', payload);
            commit('isLogged', payload);
            localStorage.setItem('isAdmin', payload);
        },
        setAdminLoggedOut({commit, dispatch}, payload){
            commit('isAdmin', payload);
            commit('isLogged', payload);
            localStorage.removeItem('token');
            localStorage.removeItem('isAdmin');
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('user');
        }
    },
    getters:{
        isLoggedIn: state => {
            return state.isLoggedIn
        }
    }
});

export default store;
