    
    <script> 
    import moment from 'moment';

    export default {
        delimiters: ['!{', '}'],
        data() {
        return {
          form: {},
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            dados: Array  // Defina o tipo de prop como um objeto
        },
        methods: {
            formatDate(date) {
            return moment(date).format('DD/MM/YY - HH:mm');
            },    
            formatCnpj(cnpj) {

            // Remove todos os caracteres não numéricos
            const digitsOnly = cnpj.replace(/\D/g, '');

            // Formata apenas os 14 primeiros dígitos
            const cnpjFormatted = digitsOnly.slice(0, 14).replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");

            // Se houver mais de 14 dígitos, inclua os dígitos adicionais
            if (digitsOnly.length > 14) {
                const extraDigits = digitsOnly.slice(14);
                return `${cnpjFormatted}.${extraDigits}`;
                }
      
            return cnpjFormatted;

        }
  }
        
    };
        // export default {
        //     delimiters: ['${{', '}}'],
        // };
        </script>;

  
    <script setup> 
    import Header from './Header.vue'

 
    </script>

<template>
    
    <Header></Header>

    <div class="Container">

        <h1 class="titulo-pagina">tabela de licitações</h1>
        <div >
            <a href="/add">
                <div class="btn adicionar">
                    
                    + Adicionar
                </div>
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>opçoes</th>
                    <th>id</th>
                    <th>nome</th>
                    <th>cnpj</th>
                    <th>modalidade</th>
                    <th>objeto</th>
                    <th>fase</th>
                    <th>prioridade</th>
                    <th>edital</th>
                    <th>data_abertura</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(dado, index) in dados" :key="index">
                    <!-- <td><a href="/lics/{{$event -> dado.id_lic}}">lic</a></td> -->
                    <!-- <td><a href='/lics/{{$lics -> dado.id_lic}}'>lic</a></td> -->
                    <td><a class="BTN-VER olho-icone" v-bind:href="'/lics/' + dado.id_lic"></a></td>
                    
                    <td>{{dado.id_lic}}.</td>
                    <td>{{dado.nome_licitador}}</td>
                    <td>{{formatCnpj(dado.cnpj_licitador)}}</td>
                    <td>{{dado.modalidade}}</td>
                    <td>{{dado.objeto}}</td>
                    <td class="fase pri-edicao" v-if="dado.nu_fase == -1"><p>edicao</p></td>
                    <td class="fase pri-descartado" v-if="dado.nu_fase == 0"><p>descartado</p></td>
                    <td class="fase pri-processada" v-if="dado.nu_fase == 1"><p>processada</p></td>
                    
                    <td class="prioridade pri-baixa" v-if="dado.prioridade == 1"><p>baixa</p></td>
                    <td class="prioridade pri-media" v-if="dado.prioridade == 2"><p>media</p></td>
                    <td class="prioridade pri-alta" v-if="dado.prioridade >= 3"><p>alta</p></td>
                    <td>{{dado.nu_edital}}</td>
                    <td>{{formatDate(dado.data_abertura)}}</td>
                    <td>{{formatDate(dado.created_at)}}</td>
                </tr>
            </tbody>
        </table>      
    </div>
        
    </template>

