<template>
  <header id="myHeader" class="">
      <div class="myContainer position-relative">
         <form class="form-inline my-2 my-lg-0 ">  
          <input class="form-control mr-sm-2" id="searchbar" type="text" placeholder="Buscar recetas..." aria-label="Search">

        </form>
         
        <div class="title position-absolute top-50 start-50 translate-middle">
          <router-link to="/" id="myTitle">Blog de Recetas</router-link>
            
        </div>
        <div v-if="user.length < 1" class="no-user text-end position-absolute top-0 end-0  ">
          <router-link to="/signup" id="log-in">Iniciar sesión</router-link>
        </div>
        <div v-else-if="user[0].type == 1">
        <div class="dropdown text-end position-absolute top-0 end-0 ">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="52" height="52" class="rounded-circle">
          </a>
          
              <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
              <li><router-link class="dropdown-item" to="/recipes_manager">Administrador de recetas</router-link></li>
              <li><a class="dropdown-item" href="#">Administrador de usuarios</a></li>
              <li><router-link class="dropdown-item" to="/profile/1">Perfil</router-link></li>
              <li><hr class="dropdown-divider"></li>
              <li><router-link class="dropdown-item" to="#">Cerrar sesión</router-link></li>
            </ul>
          </div>
        </div>

         <div v-else-if="user[0].type != 1">
           <div class="dropdown text-end position-absolute top-0 end-0 ">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="52" height="52" class="rounded-circle">
          </a>
          
              <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
              <li><a class="dropdown-item" href="#">New project...</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><router-link class="dropdown-item" to="/profile/1">Profile</router-link></li>
              <li><hr class="dropdown-divider"></li>
              <li><router-link class="dropdown-item" to="#">Cerrar sesión</router-link></li>
            </ul>
          </div>
        </div>
        
         
      </div>
  </header>

  <section>
    <router-view></router-view>
  </section>
  
  
  <!-- aquí abajo va el footer -->

</template>

<script>
export default {
  data(){
    return {
      user: [{
        id:1,
        type:1,
        name:"Administrador",
        email:"admin@email.com",
      }]
      
    }
  },
 

 beforeMount() {
        //console.log("Name:" + this.user[0].type)
        console.log(this.user.length)
    
  },

  methods: {
      
      
  }
}
</script>

<style>

</style>