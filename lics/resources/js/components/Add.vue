<script> 
export default {
    mounted() {
        console.log('Component mounted.')
    },
    props: ['csrfToken']
}

</script>



<script setup>
    import Header from './Header.vue'

    // Importando a propriedade csrfToken do componente pai
    const { props } = defineProps(['csrfToken']);
</script>

<template>
    <Header></Header>

    <div id="add-lisc">
        <h1>adicionar uma licenciatura</h1>
        <form class="form-add" action="/licitacoes" method="POST">
            <input type="hidden" name="_token" :value="csrfToken"> <!-- Adiciona o token CSRF -->
            <div class="form-group">
                <label for="" class="form-label">fase do processo:</label>
                <select id="nu_fase" name="nu_fase" class="custom-select" >
                    <option value=-1>em edicao</option>
                    <option value=0>descartada</option>
                    <option value=1>processada</option>
                 </select>
             
            </div>
            
            <div class="form-group">
                <label for="" class="form-label">edital:</label>
                <input id="nu_edital" name="nu_edital" maxlength="80" type="text">
            </div>
            
            <div class="form-group">
                <label for="" class="form-label">modalidade:</label>
                <input id="modalidade" name="modalidade" maxlength="255" type="text">
            </div>
            
            <div class="form-group">
                <label for="" class="form-label">Licitador:</label>
                <input id="nome_licitador" name="nome_licitador" maxlength="255" type="text">
            </div>
            
            <div class="form-group">
                <label for="" class="form-label">CNPJ do Licitador:</label>
                <input id="cnpj_licitador" name="cnpj_licitador" maxlength="25" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text">
            </div>
            
            <div class="form-group">
                <label for="" class="form-label">Prioridade: </label>
                <select id="prioridade" name="prioridade" class="custom-select" >
                    <option value=1>baixa</option>
                    <option value=2>media</option>
                    <option value=3>alta</option>
                 </select>
            </div>
            
            <div class="form-group">
                <label for="" class="form-label">Objeto:</label>
                <input id="objeto" name="objeto" type="text">
            </div>

            <button>Enviar</button>
        </form>
    </div>

</template>

