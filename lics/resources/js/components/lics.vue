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

  <table>
    <thead>
        <tr>
            <th>VIEW</th>
            <th>id_lic</th>
            <th>nu_fase</th>
            <th>nu_edital</th>
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
            <td><a href="/lics/{{$event -> dado.id_lic}}">lic</a></td>
            <td>{{dado.id_lic}}</td>
            <td v-if="dado.nu_fase == -1">edicao</td>
            <td v-if="dado.nu_fase == 0">descartado</td>
            <td v-if="dado.nu_fase == 1">processada</td>
            <td>{{dado.nu_edital}}</td>
            <td>{{dado.modalidade}}</td>
            <td>{{dado.data_abertura}}</td>
            <td>{{dado.nome_licitador}}</td>
            <td>{{dado.cnpj_licitador}}</td>
            <td v-if="dado.prioridade == 1">baixa</td>
            <td v-if="dado.prioridade == 2">media</td>
            <td v-if="dado.prioridade >= 3">alta</td>
            <td>{{dado.objeto}}</td>
            <td>{{dado.created_at}}</td>
        </tr>
    </tbody>
</table>      

</template>

