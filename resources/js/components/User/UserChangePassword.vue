<template>
    <div class="container-fluid">
        <top-nav></top-nav>
        <div class="container mt-3 p-1">
            <div class="row row-flex">
                <div class="col-7 bg-primary-blue p-2">
                    Schimbare Parola
                </div>
            </div>
            <div class="row row-flex">
                <div class="col-7">
                    <form>
                        <div class="mb-3">
                            <label for="parolaCurenta" class="form-label">Parola curenta</label>
                            <input type="password" class="form-control w-100" id="parolaCurenta" v-model="parola.parola_curenta">
                            <div v-show="erori.eroare_parola_curenta === true" id="eroareParolaCurenta" class="form-text">Parola curenta nu este corecta..</div>
                        </div>
                        <div class="mb-3">
                            <label for="parolaNoua" class="form-label">Introduceti parola noua: </label>
                            <input type="password" class="form-control" id="parolaNoua" v-model="parola.parola_noua">
                        </div>
                        <div class="mb-3">
                            <label for="parolaNouaConfirmare" class="form-label">Confirmati parola noua: </label>
                            <input type="password" class="form-control" id="parolaNouaConfirmare" v-model="parola.parola_confirmare">
                            <div v-show="erori.eroare_parola_noua_confirmare === true" id="eroareConfirmareParola" class="form-text">Parolele introduse nu corespund..</div>
                        </div>
                        <button type="submit" class="btn bg-change-password btn-block" @click.prevent="schimbareParola">Actualizeaza Parola Acces</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopNav from "../Menus/TopNav";
export default {
    data(){
        return{
            erori:{
                eroare_parola_curenta: false,
                eroare_parola_noua_confirmare: false
            },
            parola:{
                parola_curenta: null,
                parola_noua: null,
                parola_confirmare: null,
            },
            token: localStorage.getItem('token'),
            user: JSON.parse(localStorage.getItem('user')).id
        }
    },
    methods:{
      async schimbareParola(){
          await axios.post('/api/users/changePassword', {
              user_id: this.user,
              user_password: this.parola.parola_curenta,
              user_password_new: this.parola.parola_noua
          }, {
              headers:{
                  ContentType: 'application/json',
                  Authorization : 'Bearer ' + this.token
              }
          }).then(
              response => {
                  if(response.data.return_message == 1000){
                      this.parola.parola_curenta = "";
                      this.parola.parola_noua = "";
                      this.parola.parola_confirmare = "";

                      Vue.$toast.open({
                          message: 'Parola a fost actulalizata cu succes!',
                          type: 'success',
                          // all of other options may go here
                      });
                  }else{
                      this.parola.parola_curenta = "";
                      this.parola.parola_noua = "";
                      this.parola.parola_confirmare = "";

                      Vue.$toast.open({
                          message: 'Parola a fost actulalizata cu succes!',
                          type: 'error',
                          // all of other options may go here
                      });
                  }
              }
          )
      }
    },
    components: {
        TopNav
    }
}
</script>

<style scoped>
#eroareParolaCurenta,
#eroareConfirmareParola{
    font-weight: bolder;
    color: #e74c3c;
}
.row-flex{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.bg-change-password{
    background-color: #04ccf6;
    color: #ffffff;
    font-weight: bold;
}
</style>
