    <script setup>
    import imagemAlien from '../../../public/img/alien.png'
    import { defineProps, ref } from 'vue';
    import axios from 'axios';

    const props = defineProps({
      dados: {
        type: Object,
        required: true,
      },
       csrfToken: String,
    });


const formData = ref({
  nome_licitador: '',
  cnpj_licitador: '',
  nu_edital: '',
  objeto: '',
  modalidade: '',
  prioridade: '',
  nu_fase: ''
});




const axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1:8000', // Substitua pela URL da sua aplicação Laravel
});



const updateProduct = async () => {
  try {
    console.log(dados.value.cnpj_licitador);
    let url = `/editado/${props.dados.id_lic}`;
    const response = await axiosInstance.put(url, {
      nome_licitador: dados.value.nome_licitador,
      cnpj_licitador: dados.value.cnpj_licitador,
      nu_edital: dados.value.nu_edital,
      objeto: dados.value.objeto,
      modalidade: dados.value.modalidade,
      prioridade: dados.value.prioridade,
      nu_fase: dados.value.nu_fase
    });

    // Tratar a resposta se necessário
    console.log(response, 'teste deu certo');
  } catch (error) {
    // Tratar erros se necessário
    console.error(error, 'teste ');
  }
};

// const updateProduct = async () => {
//   try {
//     console.log(dados.value.cnpj_licitador);
//     let url = `/editado/${props.dados.id_lic}`;
//     const response = await axios.put(url, {
//       nome_licitador: dados.value.nome_licitador,
//       cnpj_licitador: dados.value.cnpj_licitador,
//       nu_edital: dados.value.nu_edital,
//       objeto: dados.value.objeto,
//       modalidade: dados.value.modalidade,
//       prioridade: dados.value.prioridade,
//       nu_fase: dados.value.nu_fase
//     });

//     // Tratar a resposta se necessário
//     console.log(response, 'teste deu certo');
//   } catch (error) {
//     // Tratar erros se necessário
//     console.error(error, 'teste ');
//   }
// };

    </script>

<template>
<div class="container-Form-Add">
    <div class="div-personagem">
        <img :src="imagemAlien" />
    </div>

    <div id="add-lisc">
        <h1>editando uma Licitação</h1>
        <form class="form-add"  :action="'/editado/'+ dados.id_lic" method="POST">
        <!-- <form class="form-add" @submit.prevent="updateProduct"> -->

            <div class="form-add-row">
                <input type="hidden" name="_token" :value="csrfToken"> <!-- Adiciona o token CSRF -->
                <input type="hidden" name="_method" value="PUT"> <!-- Adiciona o token CSRF -->

                <div class="form-group">
                    <label for="" class="form-label">Licitador:</label>
                    <input  :value="dados.nome_licitador" id="nome_licitador" name="nome_licitador" maxlength="255" type="text">
                </div>

                <div class="form-group">
                    <label for="" class="form-label">CNPJ do Licitador:</label>
                    <input  :value="dados.cnpj_licitador"  id="cnpj_licitador" name="cnpj_licitador" maxlength="25" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text">
                </div>

                <div class="form-group">
                    <label for="" class="form-label">edital:</label>
                    <input :value="dados.nu_edital" id="nu_edital" name="nu_edital" maxlength="80" type="text">
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Objeto:</label>
                    <input :value="dados.objeto" id="objeto" name="objeto" type="text">
                </div>

            </div>

    <div class="form-add-row">

        <div class="form-group">
            <label for="" class="form-label">modalidade: </label>
            <select  :value="dados.modalidade" id="modalidade" name="modalidade" class="custom-select">
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
            <select  :value="dados.prioridade" id="prioridade" name="prioridade" class="custom-select">
                <option value=1>baixa</option>
                <option value=2>media</option>
                <option value=3>alta</option>
            </select>
        </div>
        <div class="form-group">
            <label for="" class="form-label">fase do processo:</label>
            <select  :value="dados.nu_fase" id="nu_fase" name="nu_fase" class="custom-select">
                <option value=-1>em edição</option>
                <option value=0>descartada</option>
                <option value=1>processada</option>
            </select>
        </div>

        <div class="form-group">
            <label for="" class="form-label"> .</label>
            <button class="form-group form-group-button">Editar</button>
        </div>

    </div>
</form>

    </div>

</div>
</template>

