<script> 
import moment from 'moment';
export default {
    mounted() {
        console.log('Component mounted.')
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
    import { defineProps } from 'vue';

    const props = defineProps({
    dados: {
        type: Object,
        required: true,
    },
})

</script>

<template>
<div class="containerCards">

    <div   v-for="(card, index) in dados"  :key="index" >
        <div class="Card-alta Cards" v-if="card.prioridade == 1">
            <p class="titulo-info-individual-card">Nome do(a) licitador: <span>{{card.nome_licitador}}</span></p>
            <p class="titulo-info-individual-card">CNPJ do(a) licitador: <span>{{formatCnpj(card.cnpj_licitador)}}</span></p>
            <p class="titulo-info-individual-card">Modalidade da licitação: <span>{{card.modalidade}}</span> </p>
            <p class="titulo-info-individual-card">Objeto da licitação: <span>{{card.objeto}}</span> </p>
            
            <p class="titulo-info-individual-card">Edital da licitação: <span>{{card.nu_edital}}</span> </p>
            <p class="titulo-info-individual-card">Aberto em: <span>{{formatDate(card.data_abertura)}}</span> </p>
            <p class="titulo-info-individual-card">Criado em: <span>{{formatDate(card.created_at)}}</span> </p>

            <p class="titulo-info-individual-card" v-if="card.nu_fase == -1">Fase do processo: <p class="desc-item-p">edicao</p></p>
            <p class="titulo-info-individual-card" v-if="card.nu_fase == 0">Fase do processo: <p class="desc-item-p">descartado</p></p>
            <p class="titulo-info-individual-card" v-if="card.nu_fase == 1">Fase do processo: <p class="desc-item-p">processada</p></p>
            
            <p class="prioridade pri-baixa titulo-info-individual-card" v-if="card.nu_fase == -1">Prioridade da licitação: <p class="desc-item-p">Baixa</p></p>
            <p class="prioridade pri-media titulo-info-individual-card" v-if="card.nu_fase == 0">Prioridade da licitação: <p class="desc-item-p">Media</p></p>
            <p class="prioridade pri-alta titulo-info-individual-card" v-if="card.nu_fase == 1">Prioridade da licitação: <p class="desc-item-p">Alta</p></p>
            
        </div>
        <div v-else class="cardNone"></div>

        <div class="Card-media Cards" v-if="card.prioridade == 2">
            <p class="titulo-info-individual-card">Nome do(a) licitador: <span>{{card.nome_licitador}}</span></p>
            <p class="titulo-info-individual-card">CNPJ do(a) licitador: <span>{{formatCnpj(card.cnpj_licitador)}}</span></p>
            <p class="titulo-info-individual-card">Modalidade da licitação: <span>{{card.modalidade}}</span> </p>
            <p class="titulo-info-individual-card">Objeto da licitação: <span>{{card.objeto}}</span> </p>
            
            <p class="titulo-info-individual-card">Edital da licitação: <span>{{card.nu_edital}}</span> </p>
            <p class="titulo-info-individual-card">Aberto em: <span>{{formatDate(card.data_abertura)}}</span> </p>
            <p class="titulo-info-individual-card">Criado em: <span>{{formatDate(card.created_at)}}</span> </p>
            
            <p class="titulo-info-individual-card" v-if="card.nu_fase == -1">Fase do processo: <p class="desc-item-p">edicao</p></p>
            <p class="titulo-info-individual-card" v-if="card.nu_fase == 0">Fase do processo: <p class="desc-item-p">descartado</p></p>
            <p class="titulo-info-individual-card" v-if="card.nu_fase == 1">Fase do processo: <p class="desc-item-p">processada</p></p>
            
            <p class="prioridade pri-baixa titulo-info-individual-card" v-if="card.nu_fase == -1">Prioridade da licitação: <p class="desc-item-p">Baixa</p></p>
            <p class="prioridade pri-media titulo-info-individual-card" v-if="card.nu_fase == 0">Prioridade da licitação: <p class="desc-item-p">Media</p></p>
            <p class="prioridade pri-alta titulo-info-individual-card" v-if="card.nu_fase == 1">Prioridade da licitação: <p class="desc-item-p">Alta</p></p>
        </div>
        <div v-else class="cardNone"></div>


        <div class="Card-baixa Cards" v-if="card.prioridade == 3">
            <p class="titulo-info-individual-card">Nome do(a) licitador: <span>{{card.nome_licitador}}</span></p>
            <p class="titulo-info-individual-card">CNPJ do(a) licitador: <span>{{formatCnpj(card.cnpj_licitador)}}</span></p>
            <p class="titulo-info-individual-card">Modalidade da licitação: <span>{{card.modalidade}}</span> </p>
            <p class="titulo-info-individual-card">Objeto da licitação: <span>{{card.objeto}}</span> </p>
            
            <p class="titulo-info-individual-card">Edital da licitação: <span>{{card.nu_edital}}</span> </p>
            <p class="titulo-info-individual-card">Aberto em: <span>{{formatDate(card.data_abertura)}}</span> </p>
            <p class="titulo-info-individual-card">Criado em: <span>{{formatDate(card.created_at)}}</span> </p>
            
            <p class="titulo-info-individual-card" v-if="card.nu_fase == -1">Fase do processo: <p class="desc-item-p">edicao</p></p>
            <p class="titulo-info-individual-card" v-if="card.nu_fase == 0">Fase do processo: <p class="desc-item-p">descartado</p></p>
            <p class="titulo-info-individual-card" v-if="card.nu_fase == 1">Fase do processo: <p class="desc-item-p">processada</p></p>
            
            <p class="prioridade pri-baixa titulo-info-individual-card" v-if="card.prioridade == -1">Prioridade da licitação: <p class="desc-item-p">Baixa</p></p>
            <p class="prioridade pri-media titulo-info-individual-card" v-if="card.prioridade == 0">Prioridade da licitação: <p class="desc-item-p">Media</p></p>
            <p class="prioridade pri-alta titulo-info-individual-card" v-if="card.prioridade == 1">Prioridade da licitação: <p class="desc-item-p">Alta</p></p>
    </div>
    <div v-else class="cardNone"></div>

            
        </div>
    </div>
</template>

