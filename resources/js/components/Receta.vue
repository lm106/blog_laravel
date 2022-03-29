<template>

    <div class="card" style="width: 18rem;">
        <img v-bind:src="imagen" class="card-img-top image" alt="cookis">
        <div class="card-body">
            <h5 class="card-title">{{ titulo }}</h5>
            <p class="card-text">{{ des }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
  
</template>

<script>
export default {
    data() {
        return { 
            imagen: 'http://localhost:3000/images/cookis.jpg',
            descripcion: `esto es una receta de galletas sto es una receta de galletas sto es una 
                receta de galletas sto es una receta de galletas sto es una receta de galletas sto es 
                una receta de galletas sto es una receta de galletas sto es una receta de galletas sto 
                es una receta de galletas sto es una receta de galletas sto es una receta de galletassto 
                es una receta de galletas sto es una receta de galletas`,
            titulo: 'Galletas con pepitas',
            like: '',
            guardado: '',
            des: '',
            comentarios: ''
        }
    },
    beforeMount() {
        this.getDes();
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