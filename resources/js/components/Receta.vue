<template>

    <div class="card_new">
        <div style="height: 9.7rem">
            <img v-bind:src="imagen" class="card-img-top photo" alt="imagen">
        </div>
        
        <div class="card-body">
            <h5 class="card-title">{{ titulo }}</h5>

            <div class="row align-items-baseline" style="margin-top: 1rem;">

                <div class="col-6">
                    <div>
                        <p id="comentarios"> {{ comentarios }} comentarios</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="boton margin">
                        <p>
                            <img v-bind:src="save" class="info" style="vertical-align:middle;">
                        </p>
                    </div>
                </div>
                
                <div class="col-3">
                    <div class="boton">
                        <form action="cambiar.php"></form>
                        <p> {{ like[0] }}
                        <img v-bind:src="like[1]" class="info">
                        </p>
                        
                    </div>
                </div>
            </div>
            
            <router-link :to="{name: 'recipe_description', params: {id: this.receta.id}}" 
            class="btn btn-primary">Ver más</router-link>
        </div>
        
    </div>
    
  
</template>

<script>

    import img_dir from '../img_dir.js'
    import axios from 'axios';

export default {
    beforeCreate() {
        // miramos el num de likes de la receta
        axios.get(`/recipe_likes/${this.receta.id}`)
            .then(respo => {
                this.like[0] = respo.data;
            }, 
            (error) => {
                console.log(error.response.data);
            });
    },

    data() {
        return { 
            imagen: this.receta.image,
            descripcion: this.receta.description,
            titulo: this.receta.title,
            like: ['', img_dir.like],
            save: img_dir.dissave,
            comentarios: '2'
        }
    },

    props: ["receta"]
}


</script>

<style>

    .photo {
        height: 100%;
        object-fit: cover;
    }

</style>