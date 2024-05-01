    <script> 
    import moment from 'moment';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            dados: Object,   // Defina o tipo de prop como um objeto

            csrfToken: {
            type: String,
            required: true
            },

            deleteMethod: {
            type: String,
            required: true
            }
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
    }

    </script>

  
    <script setup> 
    import Header from './Header.vue'
    </script>

<template>
  <Header></Header>
  <div class="Container licitacao-individual">

      <h1> licitação do(a) <span>{{dados.nome_licitador}}</span> </h1>
<div>
    <div class="btn editar">editar</div>
    <form class="form-delete" :action="'/lics/' + dados.id_lic" method="POST">
        <input type="hidden" name="_method" :value="deleteMethod">
        <input type="hidden" name="_token" :value="csrfToken">

        <button type="submit" class="btn apagar">Apagar</button>
    </form>
</div>


      <p class="titulo-info-individual">CNPJ do(a) licitador: <span>{{formatCnpj(dados.cnpj_licitador)}}</span></p>
      <p class="titulo-info-individual">Modalidade da licitação: <span>{{dados.modalidade}}</span> </p>
      <p class="titulo-info-individual">Objeto da licitação: <span>{{dados.objeto}}</span> </p>
      
      <p class="titulo-info-individual">Edital da licitação: <span>{{dados.nu_edital}}</span> </p>
      <p class="titulo-info-individual">Aberto em: <span>{{formatDate(dados.data_abertura)}}</span> </p>
      <p class="titulo-info-individual">Criado em: <span>{{formatDate(dados.created_at)}}</span> </p>

      <p class="fase pri-edicao titulo-info-individual" v-if="dados.nu_fase == -1">Fase do processo: <p class="desc-item-p">edicao</p></p>
      <p class="fase pri-descartado titulo-info-individual" v-if="dados.nu_fase == 0">Fase do processo: <p class="desc-item-p">descartado</p></p>
      <p class="fase pri-processada  titulo-info-individual" v-if="dados.nu_fase == 1">Fase do processo: <p class="desc-item-p">processada</p></p>
      
      <p class="prioridade pri-baixa titulo-info-individual" v-if="dados.nu_fase == -1">Prioridade da licitação: <p class="desc-item-p">Baixa</p></p>
      <p class="prioridade pri-media titulo-info-individual" v-if="dados.nu_fase == 0">Prioridade da licitação: <p class="desc-item-p">Media</p></p>
      <p class="prioridade pri-alta titulo-info-individual" v-if="dados.nu_fase == 1">Prioridade da licitação: <p class="desc-item-p">Alta</p></p>
      


      <!--                           
      <td>{{dado.id_lic}}.</td>
                    <td>{{dado.nome_licitador}}</td>
                    <td>{{dado.cnpj_licitador}}</td>
                    <td>{{dado.modalidade}}</td>
                    <td>{{dado.objeto}}</td>
                    <td class="fase pri-edicao" v-if="dado.nu_fase == -1"><p>edicao</p></td>
                    <td class="fase pri-descartado" v-if="dado.nu_fase == 0"><p>descartado</p></td>
                    <td class="fase pri-processada" v-if="dado.nu_fase == 1"><p>processada</p></td>
                    
                    <td class="prioridade pri-baixa" v-if="dado.prioridade == 1"><p>baixa</p></td>
                    <td class="prioridade pri-media" v-if="dado.prioridade == 2"><p>media</p></td>
                    <td class="prioridade pri-alta" v-if="dado.prioridade >= 3"><p>alta</p></td>
                    <td>{{dado.nu_edital}}</td>
                    <td>{{dado.data_abertura}}</td>
                    <td>{{dado.created_at}}</td> 
                -->
  </div>
</template>

