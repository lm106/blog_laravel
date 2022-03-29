<template>

    <div class="back">
        <navbar></navbar>
        <div class="container-sm content">

            <!-- <div v-for="id in ids"> -->
                <receta></receta>
            <!-- </div> -->

        </div>   
    </div>
        
</template>

<script>
    import navbar from './navbar.vue'
    import receta from './Receta.vue'

export default {
    components: {navbar, receta},
    data() {
        return { 
            ids: []
        }
    }, 

    methods: {
        getPosts() {
        }
    }
}


</script>



<style>
    body{
        background-color: #F5F5F5;
    }

    .content {
        padding-top: 7.5%;
    }

    .image {
        padding: 3%;
    }

    
</style>