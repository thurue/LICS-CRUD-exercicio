<script>
 export default {
     mounted() {
         console.log('Component mounted.')
        },
     props: ['csrfToken']
    }
</script>
<script setup>
import imagemAlien from '../../../public/img/alien.png'

import Header from './Header.vue'
const {
    props
} = defineProps(['csrfToken']);

</script>

<template>
<div class="container-Form-Add">
    <div class="div-personagem">
        <img :src="imagemAlien" />
    </div>

    <div id="add-lisc">
        <h1>adicionar uma Licitação</h1>
        <form class="form-add" action="/licitacoes" method="POST">
            <div class="form-add-row">

                <input type="hidden" name="_token" :value="csrfToken"> <!-- Adiciona o token CSRF -->

                <div class="form-group">
                    <label for="" class="form-label">Licitador:</label>
                    <input id="nome_licitador" name="nome_licitador" maxlength="255" type="text">
                </div>

                <div class="form-group">
                    <label for="" class="form-label">CNPJ do Licitador:</label>
                    <input id="cnpj_licitador" name="cnpj_licitador" maxlength="25" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text">
                </div>

                <div class="form-group">
                    <label for="" class="form-label">edital:</label>
                    <input id="nu_edital" name="nu_edital" maxlength="80" type="text">
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Objeto:</label>
                    <input id="objeto" name="objeto" type="text">
                </div>

            </div>

            <div class="form-add-row">

                <div class="form-group">
                    <label for="" class="form-label">modalidade: </label>
                    <select id="modalidade" name="modalidade" class="custom-select">
                        <option id="modalidade" name="modalidade" value="Concorrência">Concorrência</option>
                        <option id="modalidade" name="modalidade" value="Tomada de Preços">Tomada de Preços</option>
                        <option id="modalidade" name="modalidade" value="Convite">Convite</option>
                        <option id="modalidade" name="modalidade" value="Concurso">Concurso</option>
                        <option id="modalidade" name="modalidade" value="Pregão">Pregão</option>
                        <option id="modalidade" name="modalidade" value="Leilão">Leilão</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Prioridade: </label>
                    <select id="prioridade" name="prioridade" class="custom-select">
                        <option value=1>baixa</option>
                        <option value=2>media</option>
                        <option value=3>alta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">fase do processo:</label>
                    <select id="nu_fase" name="nu_fase" class="custom-select">
                        <option value=-1>em edição</option>
                        <option value=0>descartada</option>
                        <option value=1>processada</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="form-label"> .</label>
                    <button class="form-group form-group-button">Enviar</button>
                </div>

            </div>
        </form>
    </div>

</div>
</template>
