<template>
  <div class="section">
      <router-link to="/lists_private">Volver atrás</router-link>
        <div class="content">
            <div class="container_fluid_new">
                <div v-for="recipe in getLists_private" :key="recipe">
                    <receta class="receta" :receta="recipe"></receta>
                </div>
             </div> 
        </div>
        <div v-if="lists_private.length==0" class="alert alert-secondary content_list" style="text-align:center;" role="alert">
            ¡Ups! No tienes recetas en esta lista
        </div>
    </div>
</template>

<script>
import Receta from '../Receta.vue';
export default {
    props:['name_list'],
    components:{Receta},
    beforeCreate(){
        axios.get(`/list_recipe/${this.name_list}`).then(res => {
            this.lists_private = res.data;
            // console.log(res);
        },
        (error) => {
            console.log(error.response.data);
        });
    },
    data(){
        return {
            lists_private:[]
        }
    },
    computed:{
        getLists_private(){
            return this.lists_private;
        }
    }

}
</script>

<style>

</style>