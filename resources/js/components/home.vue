<template>
    <div> 
        <!--<h1>{{message}}</h1> 
        <router-link to="/signup">Registrarse</router-link>-->
        <h1>{{message}}</h1>
       <router-link to="/signup">Registrarse</router-link>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: " Bienvenido World"
        }
    }
}
</script>

<style>

</style>