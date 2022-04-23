<template>
  <body class="back">
      <div class="recipe">
          .
          <div style="margin-top: 6rem;">
              <p>id: {{receta.title}}</p>
          </div>
      </div>
  </body>
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
                        vm.receta = res.data[index]
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
            receta: []
        }
    },

    beforeMount() {
        this.like = [3, img_dir.like];
    }

}
</script>

<style>

    .recipe {
        background-color: #ECE5E9;
        margin-right: 3rem;
        margin-left: 3rem;
    }

</style>