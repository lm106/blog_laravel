<template>
    <div style='margin-top:5rem;'>
        <h2> {{ title }}</h2>
        <!-- <p>Nombre: {{ name }}</p>
        <p>Apellidos: {{ name_last }}</p>
        <p>Correo Electr&oacute;nico: {{ email }}</p>
        <p>Contraseña: {{ pass }}</p> -->
        <p>{{ user }}</p>
    </div>
</template>

<script>
export default {
    beforeCreate() {
        var vm = this
        /* Para ver todos los usuarios */
        // axios.get('/profile').then(res => {
        //     vm.user = res.data;
        //     console.log(res);
        // })
        //  console.log(this.user_id);
        axios.get('/profile').then(res => {
            vm.user = res.data;
            console.log(res);
        },
        (error) => {
            console.log(error.response.data);
        })

        // axios.get('/profile')
        // .then(function (response) {
        //     // handle success
        //     this.user=response.data;
        //     console.log(response);
        // })
        // .then((response) => {
        //     this.user = response.data;
        // })
        // console.log("usuario:" + vm.user)
    },
    name: 'Profile',
    data() {
      return {
            title: 'Perfil',   
            user: []
        }
    }
    // props: ["user_id"]
}
</script>

<style>

</style>