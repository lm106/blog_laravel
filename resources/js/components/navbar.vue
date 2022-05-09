<template>
    <header id="myHeader" class="">
        <div class="myContainer position-relative">
          <form class="form-inline my-2 my-lg-0 ">  
            <input class="form-control mr-sm-2" id="searchbar" type="text" placeholder="Buscar recetas..." aria-label="Search">

          </form>
          
          <div class="title position-absolute top-50 start-50 translate-middle">
            <router-link to="/" id="myTitle">Blog de Recetas</router-link>
              
          </div>
          <div v-if="user.length < 1" class="no-user text-end position-absolute top-0 end-0" id="menu_login">
            <router-link to="/login" id="log-in">Iniciar sesión</router-link>
          </div>
          <div v-else-if="userType == 1">
          <div class="dropdown text-end position-absolute top-0 end-0 ">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/mdo.png" alt="mdo" width="52" height="52" class="rounded-circle">
            </a>
            
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><router-link class="dropdown-item" to="/recipes_manager">Administrador de recetas</router-link></li>
                <li><router-link class="dropdown-item" to="/admin_list">Administrador de usuarios</router-link></li>
                <li><router-link class="dropdown-item" to="/profile">Perfil</router-link></li>
                <li><hr class="dropdown-divider"></li>
                <li><button class="dropdown-item" @click="logout">Cerrar sesión</button></li>
              </ul>
            </div>
          </div>

          <div v-else-if="userType != 1">
            <div class="dropdown text-end position-absolute top-0 end-0 ">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/mdo.png" alt="mdo" width="52" height="52" class="rounded-circle">
            </a>
            
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><router-link class="dropdown-item" to="/profile" >Perfil</router-link></li>
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
export default {
  components: {foot},
  data(){
    return {
      user: [
      ]      
    }
  },
  computed:{
    userType(){ //verifica todo el rato si ha cambiado el tipo.
      return (this.user[0])? this.user[0].type: this.user.type;
    }
  },
  beforeCreate() {
        var vm = this
        axios.get(`/profile`).then(res => {
            (res.data)?vm.user = res.data: vm.user=res.data[0];//Recoger los datos del usuario en la session
            // console.log(res.data);
            // console.log(vm.user);
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