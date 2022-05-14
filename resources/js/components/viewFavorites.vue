<template>
    <div class="w-75" style="margin: 7rem auto;">
        <div class="container_fluid_new">
            <div v-for="recipe in getLikedRecipes" :key="recipe">
                <receta class="receta" :receta="recipe"></receta>
            </div>
        </div>
        <div v-if="liked_recipes.length == 0" class="alert alert-secondary content_list" style="text-align:center;"
            role="alert">
            ¡Ups! No hay recetas favoritas.
        </div>
    </div>
</template>

<script>
import Receta from './Receta.vue';

export default {
    components: { Receta },
    beforeCreate() {
        axios.get('/profile').then(res => {
            axios.get(`/getUserLikes/${res.data[0].id}`).then(res => {
                this.liked_recipes = res.data
            },(error) => {
                console.log(error.response.data);
            });
        },(error) => {
            console.log(error.response.data);
        });

    },
    data() {
        return {
            liked_recipes: [],
            user_id: null,
        }
    },
    computed: {
        getLikedRecipes() {
            return this.liked_recipes;
        }
    },
    methods: {
        getLikes() {
            axios.get('/getUserLikes', { user_id: this.user_id }).then(res => {
                console.log(res.data)
            })
        },
    },
}
</script>