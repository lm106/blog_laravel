<template>
<section>
    <div class="col-6 mx-auto contenedor">
        <div class="p-5 text-center">
            <h2 class="text-center"><u>Formulario de Contacto</u></h2>
            <form action="#" class="d-flex flex-column pt-5">
                <input class="col-6 mx-auto mt-3" type="text" name="nombre" id="userName" placeholder="Nombre" autocomplete="off"><br>
                <input class="col-6 mx-auto mt-3" type="email" name="email" id="userEmail" placeholder="Correo electronico" autocomplete="off"><br>
                <input class="col-6 mx-auto mt-3" type="text" name="asunto" id="asuntoContacto" placeholder="Concepto" autocomplete="off"><br>
                <textarea class="col-6 mx-auto mt-3" placeholder="Cuerpo de la solicitud"></textarea>
            </form>
            <button class="btn btn-primary col-3 mx-auto" @click="enviarDatos">Enviar Solicitud</button>
        </div>
    </div>
</section>
  
</template>

<script>
export default {
    methods:{
        enviarDatos(){
            alert('Datos enviados correctamente')
            window.location.href = '/'
        }
    }
}
</script>

<style>
    section{
        margin-top: 3rem;
        margin-bottom: 2rem;
    }
    .contenedor{
        background-color: #ECE5E9;
        width: 850px;
        height: 700px;
    }
    h2{
        color: #AB8A62;
    }
    textarea{
        min-height: 250;
        resize: none;
        background: #ECE5E9;
        border: 1px solid #AB8A62;
        box-sizing: border-box;
        border-radius: 4px;
    }
    .btn-primary{
        background-color: #AB8A62;
        color:white;
        border-color: #AB8A62;
    }
    .btn-primary:hover{
        background-color: #917450;
        color:white;
        border-color: #917450;
    }

    input{
        background: #ECE5E9;
        border: 1px solid #AB8A62;
        box-sizing: border-box;
        border-radius: 4px;
    }
</style>