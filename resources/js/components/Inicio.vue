<template>

    <div class="back">
        <navbar></navbar>
        <div class="container-fluid content">

            <div v-for="id in ids" :receta="id">
                <receta class="receta" :receta="id"></receta>
            </div>

        </div>   
    </div>
        
</template>

<script>
    import axios from 'axios'
    import navbar from './navbar.vue'
    import receta from './Receta.vue'

export default {
    components: {navbar, receta},
    beforeCreate() {
        var vm = this
        axios.get('/recetas')
            .then(res => { 
                vm.ids = res.data,
                console.log(res.data) 
            }, 
            (error) => {
                console.log(error.response.data);
            })
    },

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
        padding-top: 6rem;
    }
    
</style>