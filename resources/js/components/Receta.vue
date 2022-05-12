<template>

    <div class="card_new">
        <div style="height: 9.7rem">
            <img v-bind:src="imagen" class="card-img-top photo" alt="imagen">
        </div>
        
        <div class="card-body">
            <h5 class="card-title">{{ titulo }}</h5>

            <div class="row align-items-baseline" style="margin-top: 1rem;">

                <div class="col-9">
                    <div>
                        <p id="comentarios"> {{ comment }} comentarios</p>
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
        // miramos el num de likes y commentarios de la receta
        axios.get(`/recipe_likes/${this.receta.id}`)
            .then(respo => {
                this.like[0] = respo.data[0];
                this.comment = respo.data[1];
            }, 
            (error) => {
                console.log(error.response.data);
            });
    },

    data() {
        return { 
            imagen: img_dir.url + this.receta.image,
            descripcion: this.receta.description,
            titulo: this.receta.title,
            like: ['', img_dir.url+img_dir.like],
            save: img_dir.dissave,
            comment: ''
        }
    },
    watch:{
        receta(val){
            this.titulo=val.title;
            this.imagen = val.image;
            this.descripcion = val.description;    
            this.loadLikeComment();        
        }
    },

    props: ["receta"], 

    methods: {
        loadLikeComment() {
            axios.get(`/recipe_likes/${this.receta.id}`)
            .then(respo => {
                this.like[0] = respo.data[0];
                this.comment = respo.data[1]
            }, 
            (error) => {
                console.log(error.response.data);
            });
        }
    }
}


</script>

<style>

    .photo {
        height: 100%;
        object-fit: cover;
    }

</style>