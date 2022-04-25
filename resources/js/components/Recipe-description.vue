<template>
  <section class="container_fluid_new">
      <div class="recipe">
          .
          <div id="content">
              <div>

                  <div id="title"></div>
                  <h1>{{recipe.title}}</h1>

              </div>
              
              
              <p>id: {{recipe.description}}</p>
              <p>id: {{recipe.user_id}}</p>
          </div>
      </div>
  </section>
</template>

<script>

import img_dir from '../img_dir.js'
import axios from 'axios'

export default {
    props: ["id"],

    beforeCreate() {
        var vm = this
        axios.get('/recetas')
            .then(res => { 
                for (let index = 0; index < res.data.length; index++) {
                    if (res.data[index].id == vm.id) {
                        vm.recipe = res.data[index]
                        break
                    }
                }
            }, 
            (error) => {
                console.log(error.response.data);
            })
    },

    data() {
        return { 
            recipe: []
        }
    },

    beforeMount() {
        this.like = [3, img_dir.like];
    }

}
</script>

<style>
    #content {
        margin-top: 6rem;
        margin-right: 3rem;
        margin-left: 3rem;
    }

    .recipe {
        background-color: #ECE5E9;
        margin-right: 3rem;
        margin-left: 3rem;
    }

    h1 {
        text-align: center;
        font-family: 'Rouge Script';
        font-style: normal;
        align-items: center;
        margin-top: -2.1rem;
    }

    #title {
        background: #EFC6CD;
        height: 1rem;
        border-radius: 30px;
    }

</style>