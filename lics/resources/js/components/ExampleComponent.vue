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
        // props: {
        //     dados: Array  // Defina o tipo de prop como um objeto
        // },
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

</script>;
  <script setup>
  import { defineProps, computed, ref, onMounted } from 'vue';
//   import Pagination from 'vue-pagination-2';
  
  const props = defineProps({
  dados: {
    type: Array,
    required: true,
  },
  headers: {
    type: Array,
    default: () => [
      "Opções",
      "ID",
      "Nome",
      "CNPJ",
      "Modalidade",
      "Objeto",
      "Fase",
      "Prioridade",
      "Edital",
      "Data de Abertura",
      "Criado em"
    ]
  },
  porPage: {
    type: Number,
    default: 10,
  },
  AtualPage: {
    type: Number,
    default: 0,
  },
});

const porPageRef = ref(props.porPage);
const paginaAtual = ref(props.AtualPage);
// botoes de paginas
const totalDePaginas = computed(()=>
    Math.ceil(props.dados.length / porPageRef.value)
)

// calcula qual vai ser o inivio e o fim da tabela que serao exibidos na tela
const Iniciotabela = computed(() => (porPageRef.value) * paginaAtual.value);
const Fimtabela = computed(() => Iniciotabela.value + porPageRef.value);

// valida todos os dados e trás um array com os objetos que serao exibidos na tabela
const  ArrayModalidade = ref([])
const  ArrayFases = ref([])
const  ArrayPrioridades = ref([])

    const ItemsDaTabelAtual = computed(() => {
        const objetosComNomesContidos = ref([]);
        
        props.dados.forEach(objeto => {
    if (
        ArrayModalidade.value.includes(objeto.modalidade) || 
        ArrayFases.value.includes(objeto.nu_fase) ||
        ArrayPrioridades.value.includes(objeto.prioridade)) {
        objetosComNomesContidos.value.push(objeto);
    }
});

        // props.dados.forEach(objeto => {
        //     if (ArrayModalidade.value.includes(objeto.modalidade)) {
        //         objetosComNomesContidos.value.push(objeto);
        //     }
        // });
        
        // props.dados.forEach(objeto => {
        //     if (ArrayFases.value.includes(objeto.nu_fase)) {
        //         objetosComNomesContidos.value.push(objeto);
        //     }
        // });

        // props.dados.forEach(objeto => {
        //     if (ArrayPrioridades.value.includes(objeto.prioridade)) {
        //         objetosComNomesContidos.value.push(objeto);
        //     }
        // });
   
        console.log(objetosComNomesContidos.value)

        const inicio = Math.max(Iniciotabela.value , 0); 
        const fim = Math.min(Fimtabela.value, objetosComNomesContidos.value.length ); 
        const ArrayComInicioFim = objetosComNomesContidos.value.slice(inicio, fim)

// retorna um array validado por todos os checkers
    return ArrayComInicioFim;
    });


const items = ref([
  { nome: "Concorrência" , checked: true },
  { nome: "Convite" , checked: true },
  { nome: "Concurso" , checked: true },
  { nome: "Pregão" , checked: true },
  { nome: "Leilão" , checked: true },
]);
const Fases = ref([
  {numero:-1, nome: "edicao",  checked: true },
  {numero:0, nome: "descartada", checked: true },
  {numero:1, nome: "processada" ,checked: true },

]);
const Prioridade = ref([
  {numero:1, nome: "baixa" , checked: true },
  {numero:2, nome: "media" , checked: true },
  {numero:3, nome: "alta" , checked: true },

]);

onMounted(() => {
  initializeCheckedItems();
});

function initializeCheckedItems() {
  items.value.forEach(item => {
    if (item.checked) {
      ArrayModalidade.value.push(item.nome);
    }
  });
  Fases.value.forEach(item => {
    if (item.checked) {
      ArrayFases.value.push(item.numero);
    }
  });
  Prioridade.value.forEach(item => {
    if (item.checked) {
      ArrayPrioridades.value.push(item.numero);
    }
  });
}
  </script>

<template>
    
    <!-- <Header></Header> -->
    <div class="root">
        
        <div class="side-bar">
            
            <div class="nav-sidebar">
                <a href="/add">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                </a> 
                
                <a href="/card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z"/></svg>
                </a>

                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
                </a> 


                

            </div>
            <div class="configurate-sidebar">

                <h3>Prioridade</h3>
                <div v-for="Prioridade in Prioridade" class="modalidade-group">
                    <input  type="checkbox" :id=Prioridade.nome  :value=Prioridade.numero  v-model="ArrayPrioridades" />
                    <label :for=Prioridade.nome>{{Prioridade.nome}}</label>
                </div>

                <h3>FASE</h3>
                <div v-for="Fases in Fases" class="modalidade-group">
                    <input  type="checkbox" :id=Fases.nome  :value=Fases.numero  v-model="ArrayFases" />
                    <label :for=Fases.nome>{{Fases.nome}}</label>
                </div>

                <h3>MODALIDADE</h3>
                <div v-for="item in items" class="modalidade-group">
                    <input  type="checkbox" :id=item.nome  :value=item.nome  v-model="ArrayModalidade" />
                    <label :for=item.nome>{{item.nome}}</label>
                </div>

            </div>
            
        </div>
    
    <div class="Container">
        
        <h1 class="titulo-pagina">tabela de licitações</h1>
        
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
                <tr v-for="(dado, index) in ItemsDaTabelAtual" :key="index">
                    
                    <td>
                    <a class="olho-icone" v-bind:href="'/lics/' + dado.id_lic">
                        
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>

                    </a>
                    </td>
                    
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
        
        <div>

            <button   v-for="(item, index) in totalDePaginas" @click="()=>{paginaAtual = index}">{{ index + 1 }}</button>

        </div>
    </div> 
    
</div>
</template>


    