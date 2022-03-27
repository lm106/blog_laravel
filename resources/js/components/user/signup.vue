<template>
  <div>
      estoy en Registrarse
      <form>
        <input v-model="input" placeholder="name" />
      </form>
      <p>{{ input }}</p>
  </div>
</template>

<script>
export default {
    name:'signup',
    data() {
      return {
        input: ''
      }
    }
}
</script>

<style>

</style>