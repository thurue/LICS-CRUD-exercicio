    <script> 
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            dados: {
                type: Object,
                required: true
            }
        }
    }

    </script>

  
    <script setup> 

    import Header from './Header.vue'
    </script>

<template>
    <Header></Header>
    <h1>essa é a home</h1>
  <p>{{ dados.idade }} </p>
</template>

