<template>
    <div class="w-75" style="margin: 7rem auto;">
        <h3 v-if="finded_recipes.length>0">Resultados para "{{search}}":</h3>
        <div class="container_fluid_new">
            <div v-for="recipe in getFindedRecipes" :key="recipe">
                <receta class="receta" :receta="recipe"></receta>
            </div>
        </div>
        <div v-if="finded_recipes.length==0" class="alert alert-secondary content_list" style="text-align:center;" role="alert">
            ¡Ups! No hay recetas que coincidan con la busqueda.
        </div>
    </div>
</template>

<script>
import Receta from './Receta.vue';
export default {
    components:{Receta},
    props:['search'],
    beforeCreate() {
        axios.get(`/recipes_finder/${this.search}`).then(res => {
            this.finded_recipes = res.data;
            console.log(res);
        },
        (error) => {
            console.log(error.response.data);
        });
    },
    data() {
        return {
            finded_recipes:[]
        }
    },
    computed:{
        getFindedRecipes(){
            return this.finded_recipes;
        }
    }
}
</script>