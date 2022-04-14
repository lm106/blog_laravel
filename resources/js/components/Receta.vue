<template>

    <div class="card_new" style="width: 18rem;">
        <img v-bind:src="imagen" class="card-img-top image" alt="cookis">
        <div class="card-body">
            <h5 class="card-title">{{ titulo }}</h5>
            <p class="card-text">{{ des }}</p>

            <div class="row align-items-baseline">

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
            
            <a href="#" class="btn btn-primary">Ver más</a>
        </div>
        
    </div>
    
  
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return { 
            imagen: 'http://localhost:3000/images/cookis.jpg',
            descripcion: `esto es una receta de galletas sto es una receta de galletas sto es una 
                receta de galletas sto es una receta de galletas sto es una receta de galletas sto es 
                una receta de galletas sto es una receta de galletas sto es una receta de galletas sto 
                es una receta de galletas sto es una receta de galletas sto es una receta de galletassto 
                es una receta de galletas sto es una receta de galletas`,
            titulo: '',
            like: ['', ''],
            save: 'http://localhost:3000/images/dissave.jpg',
            des: '',
            comentarios: '2'
        }
    },

    created() {
      axios.get('/recetas')
        .then(response => console.log(response.data))
        .cactch();
    },

    beforeMount() {
        this.getDes();
        this.like = [3, 'http://localhost:3000/images/like2.jpg'];
    },

    methods: {
        
        getDes() {
            this.des = this.descripcion.substring(0,100) + "...";
        }
    }
}


</script>

<style>

</style>