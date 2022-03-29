r<template>
  <header id="myHeader" class="">
      <div class="myContainer position-relative">
         <form class="form-inline my-2 my-lg-0 ">  
          <input class="form-control mr-sm-2" id="searchbar" type="text" placeholder="Buscar recetas..." aria-label="Search">

        </form>
         
        <div class="title position-absolute top-50 start-50 translate-middle">
            <a id="myTitle" href="" class="">Blog de Recetas</a>
        </div>

        <div class="dropdown text-end position-absolute top-0 end-0 ">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="52" height="52" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
  </header>
  
</template>

<script>
export default {

}
</script>

<style>

</style>