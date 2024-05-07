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
            // formatar data
            formatDate(date) {
            return moment(date).format('DD/MM/YY - HH:mm');
            },
            // formatar cnpj
            formatCnpj(cnpj) {
            const digitsOnly = cnpj.replace(/\D/g, '');
            const cnpjFormatted = digitsOnly.slice(0, 14).replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");
            if (digitsOnly.length > 14) {
                const extraDigits = digitsOnly.slice(14);
                return `${cnpjFormatted}.${extraDigits}`;
                }

            return cnpjFormatted;

        },

  }
    }

    </script>


    <script setup>
    import Header from './Header.vue'

    </script>

<template>
  <div class="Container licitacao-individual">
      <h1> licitação <span>{{dados.nome_licitador}}</span> </h1>
<div>
    <a v-bind:href="'/edit/' +  dados.id_lic">
        <div class="btn editar-individual">editar</div>
    </a>
    <form class="form-delete" :action="'/lics/' + dados.id_lic" method="POST">
        <input type="hidden" name="_method" :value="deleteMethod">
        <input type="hidden" name="_token" :value="csrfToken">

        <button type="submit" class="btn excluir-individual">Apagar</button>
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

  </div>
</template>

