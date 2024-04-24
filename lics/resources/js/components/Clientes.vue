<script> 
export default {
    mounted() {
        console.log('Component mounted.')
    },
    props: {
            id: {
                type: String,
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
<div >{{id}}</div>
</template>

