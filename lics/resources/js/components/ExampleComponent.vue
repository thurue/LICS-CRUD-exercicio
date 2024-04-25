    <script> 
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            dados: Array  // Defina o tipo de prop como um objeto
        }
    }

    </script>

  
    <script setup> 
    import Header from './Header.vue'
    </script>

<template>
    <Header></Header>
    <!-- <p v-for="(dado, index) in dados" :key="index"> 
    {{ dado.id_lic }} -- 
    {{ dado.nu_fase }} -- 
    {{ dado.nu_edital }} -- 
    {{ dado.id_lic }} -- 
    {{ dado.modalidade }} -- 
    {{ dado.modalidade }} -- 
    {{ dado.nome_licitador }} -- 
      </p> -->

<table>
    <thead>
        <tr>
            <th>id_lic</th>
            <th>nu_fase</th>
            <th>nu_edital</th>
            <th>id_lic</th>
            <th>modalidade</th>
            <th>data_abertura</th>
            <th>nome_licitador</th>
            <th>cnpj_licitador</th>
            <th>prioridade</th>
            <th>objeto</th>
            <th>created_at</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(dado, index) in dados" :key="index">
            <td>{{dado.id_lic}}</td>
            <td>{{dado.nu_fase}}</td>
            <td>{{dado.nu_edital}}</td>
            <td>{{dado.id_lic}}</td>
            <td>{{dado.modalidade}}</td>
            <td>{{dado.data_abertura}}</td>
            <td>{{dado.nome_licitador}}</td>
            <td>{{dado.cnpj_licitador}}</td>
            <td>{{dado.prioridade}}</td>
            <td>{{dado.objeto}}</td>
            <td>{{dado.created_at}}</td>
        </tr>
    </tbody>
</table>      

</template>

