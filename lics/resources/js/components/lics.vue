    <script> 
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            dados: Object   // Defina o tipo de prop como um objeto
        }
    }

    </script>

  
    <script setup> 
    import Header from './Header.vue'
    </script>

<template>
  <Header></Header>
  <p>{{ dados.id_lic }}</p>
  <h1>HELLO WORLD!!!!!!!!!</h1>
</template>

