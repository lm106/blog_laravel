<template>

    <div class="card_new">
        <img v-bind:src="imagen" class="card-img-top image" alt="cookis">
        <div class="card-body">
            <h5 class="card-title">{{ titulo }}</h5>
            <p class="card_text_new">{{ des }}</p>

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

    import img_dir from '../img_dir.js'

export default {
    data() {
        return { 
            imagen: 'http://localhost:3000/images/cookis.jpg',
            descripcion: this.receta.description,
            titulo: this.receta.title,
            like: ['', ''],
            save: img_dir.dissave,
            des: '',
            comentarios: '2'
        }
    },

    props: ["receta"],

    beforeMount() {
        this.getDes();
        this.like = [3, img_dir.like];
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