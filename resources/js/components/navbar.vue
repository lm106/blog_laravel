<template>
    <header id="myHeader" class="">
        <div class="myContainer position-relative">
          <div class="form-inline my-2 my-lg-0 ">  
            <input class="form-control mr-sm-2" id="searchbar" type="text" placeholder="Buscar recetas..." v-model="search" @keypress.enter="buscarRecetas" autocomplete="off">
          </div>
          
          <div class="title position-absolute top-50 start-50 translate-middle">
            <router-link to="/" id="myTitle">Blog de Recetas</router-link>
              
          </div>
          <div v-if="!user" class="no-user text-end position-absolute top-0 end-0" id="menu_login">
            <router-link to="/login" id="log-in">Iniciar sesión</router-link>
          </div>
          <div v-else-if="userType == 1">
          <div class="dropdown text-end position-absolute top-0 end-0 ">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img v-bind:src="imagen + getUser.photo" width="52" height="52" class="rounded-circle">
            </a>
            
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><router-link class="dropdown-item" to="/lists_private">Ver listas privadas</router-link></li>
                <li><router-link class="dropdown-item" to="/show_favorites">Ver recetas favoritas</router-link></li>
                <li><router-link class="dropdown-item" to="/recipes_manager">Administrador de recetas</router-link></li>
                <li><router-link class="dropdown-item" to="/list_users">Administrador de usuarios</router-link></li>
                <li><router-link class="dropdown-item" to="/perfil">Mi perfil</router-link></li>
                <li><hr class="dropdown-divider"></li>
                <li><button class="dropdown-item" @click="logout">Cerrar sesión</button></li>
              </ul>
            </div>
          </div>

          <div v-else-if="userType != 1">
            <div class="dropdown text-end position-absolute top-0 end-0 ">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img  v-bind:src="imagen + getUser.photo" width="52" height="52" class="rounded-circle">
            </a>
            
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><router-link class="dropdown-item" to="/lists_private">Ver listas privadas</router-link></li>
                <li><router-link class="dropdown-item" to="/show_favorites">Ver recetas favoritas</router-link></li>
                <li><router-link class="dropdown-item" to="/perfil" >Mi perfil</router-link></li>
                <li><hr class="dropdown-divider"></li>
                <li><button class="dropdown-item" @click="logout">Cerrar sesión</button></li>
              </ul>
            </div>
          </div>

        </div>
    </header>
    <section>
      <router-view></router-view>
    </section>
    <!-- aquí abajo va el footer -->
    <foot></foot>
</template>

<script>
import foot from './Foot.vue'
import img_dir from '../img_dir.js'
export default {
  components: {foot},
  data(){
    return {
      user: [],
      imagen: img_dir.url,
      search:null   
    }
  },
  computed:{
    userType(){ //verifica todo el rato si ha cambiado el tipo.
      return (this.user[0])? this.user[0].type: this.user.type;
    },
    getUser(){
      return (this.user[0])? this.user[0]: this.user;
    }
  },
  beforeCreate() {
        var vm = this
        axios.get(`/profile`).then(res => {
            vm.user = res.data;//Recoger los datos del usuario en la session
        },
        (error) => {
            console.log(error.response.data);
        })
    },
  methods: {
      logout(){
        console.log("ey estoy dentro");
        var vm=this;
        axios.post('/logout').
            then(() => {
            // console.log('logout');
            vm.user=[]; // Ya no existe el usuario
            window.location.href='/'; 
            // console.log(vm.user);
        },
        (error) => {
            console.log(error.response.data);
        });
      },
      buscarRecetas(){
        window.location.href = `/find_recipes/${this.search}`

      }
      
  }
}
</script>

<style>
#log-in{
  text-decoration: none;
  color:black
}
#menu_login{
  margin-top: 15px;
}
</style>
