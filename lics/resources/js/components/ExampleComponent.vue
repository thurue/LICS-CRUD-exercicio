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
</script>

<script setup>
import {
    defineProps,
    computed,
    ref,
    onMounted
} from 'vue';
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
const totalDePaginas = computed(() =>
    Math.ceil(props.dados.length / porPageRef.value)
)

// calcula qual vai ser o inivio e o fim da tabela que serao exibidos na tela
const Iniciotabela = computed(() => (porPageRef.value) * paginaAtual.value);
const Fimtabela = computed(() => Iniciotabela.value + porPageRef.value);

// valida todos os dados e trás um array com os objetos que serao exibidos na tabela
const ArrayColunas = ref([])
const ArrayModalidade = ref([])
const ArrayFases = ref([])
const ArrayPrioridades = ref([])

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

    console.log(objetosComNomesContidos.value)

    const inicio = Math.max(Iniciotabela.value, 0);
    const fim = Math.min(Fimtabela.value, objetosComNomesContidos.value.length);
    const ArrayComInicioFim = objetosComNomesContidos.value.slice(inicio, fim)

    // retorna um array validado por todos os checkers
    return {
        ArrayComInicioFim: ArrayComInicioFim,
        inicio: inicio,
        fim: fim
    };
});

const colunas = ref([{
        nome: "id",
        checked: true,
    },
    {
        nome: "nome",
        checked: true,
    },
    {
        nome: "cnpj",
        checked: true,
    },
    {
        nome: "modalidade",
        checked: true,
    },
    {
        nome: "objeto",
        checked: true,
    },
    {
        nome: "fase",
        checked: true,
    },
    {
        nome: "prioridade",
        checked: true,
    },
    {
        nome: "edital",
        checked: true,
    },
    {
        nome: "data_abertura",
        checked: true,
    },
    {
        nome: "created_at",
        checked: true,
    },]);

const items = ref([{
        nome: "Concorrência",
        checked: true
    },
    {
        nome: "Convite",
        checked: true
    },
    {
        nome: "Concurso",
        checked: true
    },
    {
        nome: "Tomada de Preços",
        checked: true
    },
    {
        nome: "Pregão",
        checked: true
    },
    {
        nome: "Leilão",
        checked: true
    },
]);
const Fases = ref([{
        numero: -1,
        nome: "edicao",
        checked: true
    },
    {
        numero: 0,
        nome: "descartada",
        checked: true
    },
    {
        numero: 1,
        nome: "processada",
        checked: true
    },

]);
const Prioridade = ref([{
        numero: 1,
        nome: "baixa",
        checked: true,
    },
    {
        numero: 2,
        nome: "media",
        checked: true,
    },
    {
        numero: 3,
        nome: "alta",
        checked: true,
    },

]);

onMounted(() => {
    CheckItems();
    CheckColunas();
    alternarJanela();
});

function CheckColunas() {
    colunas.value.forEach(item => {
        if (item.checked) {
            ArrayColunas.value.push(item.nome);
            console.log(ArrayColunas, 'aquii')
        }
    });
}
function CheckItems() {
    items.value.forEach(item => {
        if (item.checked) {
            ArrayModalidade.value.push(item.nome);
            console.log(ArrayModalidade, 'aquii 22222')
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

function unCheckItems() {
    
    items.value.forEach(item => {
        if (item.checked) {
            ArrayModalidade.value = [];
        }
    });
    
    Fases.value.forEach(item => {
        if (item.checked) {
            ArrayFases.value = []
        }
    });
    
    Prioridade.value.forEach(item => {
        if (item.checked) {
            ArrayPrioridades.value = []
        }
    });
}
const alternar = ref(2)

function alternarFunction() {
    if (alternar.value == 2) {
        unCheckItems()
        return alternar.value--
    }
    if (alternar.value == 1) {
        CheckItems()
        return alternar.value++
    }
}

const styleJanela = ref('some-janela');
function alternarJanela() {
    if (styleJanela.value == 'some-janela') {
        return styleJanela.value = ''
    }
    if (styleJanela.value == '') {
        return styleJanela.value = 'some-janela'
    }
}


</script>

<template>
    <!-- <Header></Header> -->
<div class="root">

    <div class="side-bar">

        <div class="nav-sidebar">
            <a href="/add">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" fill="url(#meuGradiente)" />
                    <linearGradient id="meuGradiente" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:rgb(114, 23, 105)" />
                        <stop offset="100%" style="stop-color:rgb(234, 28, 70)" />
                    </linearGradient>
                    <mask id="maskGradiente">
                        <rect x="0" y="0" width="100%" height="100%" fill="url(#meuGradiente)" />
                    </mask>
                </svg>
            </a>

            <a href="/card">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z" fill="url(#meuGradiente)" />
                    <linearGradient id="meuGradiente" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:rgb(114, 23, 105)" />
                        <stop offset="100%" style="stop-color:rgb(234, 28, 70)" />
                    </linearGradient>
                    <mask id="maskGradiente">
                        <rect x="0" y="0" width="100%" height="100%" fill="url(#meuGradiente)" />
                    </mask>
                </svg>
            </a>

            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z" fill="url(#meuGradiente)" />
                    <linearGradient id="meuGradiente" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:rgb(114, 23, 105)" />
                        <stop offset="100%" style="stop-color:rgb(234, 28, 70)" />
                    </linearGradient>
                    <mask id="maskGradiente">
                        <rect x="0" y="0" width="100%" height="100%" fill="url(#meuGradiente)" />
                    </mask>
                </svg>
            </a>
        </div>

        <div class="configurate-sidebar">

            <h3>PRIORIDADE</h3>
            <div v-for="Prioridade in Prioridade" class="modalidade-group">
                <input type="checkbox" :id=Prioridade.nome :value=Prioridade.numero v-model="ArrayPrioridades" />
                <label :for=Prioridade.nome>{{Prioridade.nome}}</label>
            </div>

            <h3>FASE</h3>
            <div v-for="Fases in Fases" class="modalidade-group">
                <input type="checkbox" :id=Fases.nome :value=Fases.numero v-model="ArrayFases" />
                <label :for=Fases.nome>{{Fases.nome}}</label>
            </div>

            <h3>MODALIDADE</h3>
            <div v-for="item in items" class="modalidade-group">
                <input type="checkbox" :id=item.nome :value=item.nome v-model="ArrayModalidade" />
                <label :for=item.nome>{{item.nome}}</label>
            </div>

            <div @click="alternarFunction()" class="btn-todos-acima">
                <input type="button" id="alternar" value="alternar todos">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path d="M32 448c-17.7 0-32 14.3-32 32s14.3 32 32 32l96 0c53 0 96-43 96-96l0-306.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 109.3 160 416c0 17.7-14.3 32-32 32l-96 0z" /></svg>
            </div>

            
        
        </div>

    </div>

    <div class="Container">

        <div class="headline-table">
            <h1 class="headline-titulo-pagina">LICITAÇÕES</h1>
            <div class="right-part-headline">

                <div class="numero-de-itens-atualmente">
                    <p>{{ ItemsDaTabelAtual.inicio }} - {{ ItemsDaTabelAtual.fim }} items de {{props.dados.length}}</p>

                    <svg v-on:click="() => {  if (paginaAtual > 0) {paginaAtual--} }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" /></svg>

                    <svg v-on:click="() => { if (paginaAtual + 1 < totalDePaginas) {paginaAtual++} }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" /></svg>
                </div>

                <div class="btn adicionar adicionar-tabela div-button-colunas">
                    <a @click="alternarJanela()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm64 64V416H224V160H64zm384 0H288V416H448V160z"/></svg>
                    </a>

                    <div :class="'janela-colunas ' + styleJanela">
                        <div v-for="(item, index) in colunas" class="modalidade-group">
                            <input type="checkbox" :id=item.nome :value=item.nome v-model="ArrayColunas" />
                            <label :for=item.nome>{{item.nome}}</label>
                        </div>
                    </div>
                </div>


                <div class="btn adicionar adicionar-tabela">
                    <a href="/add">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />

                        </svg>
                    </a>
                    <h1>NOVO</h1>
                </div>
            </div>
        </div>

        <table class="TABELA">
            <thead class="cabecalho-TABELA">
                <tr class="cabecalho-TABELA-unidade"  >
                    
                    <!-- <th v-for="(dado, index) in ArrayColunas" id="primeira-coluna">{{dado}}</th> -->
                    <th id="primeira-coluna">opçoes</th>
                    <th class="col-aparece" v-if="ArrayColunas.includes('id')" >id</th>
                    <th class="col-some" v-else>id</th>
                    
                    <th class="col-aparece" v-if="ArrayColunas.includes('nome')">nome</th>
                    <th class="col-some" v-else>nome</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('cnpj')">cnpj</th>
                    <th class="col-some" v-else>cnpj</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('modalidade')">modalidade</th>
                    <th class="col-some" v-else>modalidade</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('objeto')">objeto</th>
                    <th class="col-some" v-else>objeto</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('fase')">fase</th>
                    <th class="col-some" v-else>fase</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('prioridade')">prioridade</th>
                    <th class="col-some" v-else>prioridade</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('edital')">edital</th>
                    <th class="col-some" v-else>edital</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('data_abertura')">data_abertura</th>
                    <th class="col-some" v-else>data_abertura</th>

                    <th class="col-aparece" v-if="ArrayColunas.includes('created_at')">created_at</th> 
                    <th class="col-some" v-else>created_at</th> 

                </tr>
            </thead>
            <tbody class="corpo-TABELA">
                <tr class="corpo-TABELA-unidade" v-for="(dado, index) in ItemsDaTabelAtual.ArrayComInicioFim" :key="index">
                    <td>
                        <a class="olho-icone" v-bind:href="'/lics/' + dado.id_lic">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" /></svg>

                        </a>
                    </td>

                    <td class="col-aparece" v-if="ArrayColunas.includes('id')" >{{dado.id_lic}}.</td>
                    <td class="col-some" v-else>{{dado.id_lic}}.</td>


                    <td class="col-aparece" v-if="ArrayColunas.includes('nome')" >{{dado.nome_licitador}}</td>
                    <td class="col-some" v-else>{{dado.nome_licitador}}</td>


                    <td class="col-aparece" v-if="ArrayColunas.includes('cnpj')" >{{formatCnpj(dado.cnpj_licitador)}}</td>
                    <td class="col-some" v-else >{{formatCnpj(dado.cnpj_licitador)}}</td>


                    <td class="col-aparece" v-if="ArrayColunas.includes('modalidade')" >{{dado.modalidade}}</td>
                    <td class="col-some" v-else >{{dado.modalidade}}</td>


                    <td class="col-aparece" v-if="ArrayColunas.includes('objeto')" >{{dado.objeto}}</td>
                    <td class="col-some" v-else>{{dado.objeto}}</td>


                    <td  class= "col-aparece fase pri-edicao" v-if="dado.nu_fase == -1 && ArrayColunas.includes('fase')">
                        <p>edicao</p>
                    </td>
                    <td  class="col-some fase pri-edicao" v-else>
                        <p>edicao</p>
                    </td>


                    <td class="col-aparece fase pri-descartado" v-if="dado.nu_fase == 0 && ArrayColunas.includes('fase')">
                        <p>descartado</p>
                    </td>
                    <td class="col-some fase pri-descartado" v-else>
                        <p>descartado</p>
                    </td>


                    <td class="col-aparece fase pri-processada" v-if="dado.nu_fase == 1 && ArrayColunas.includes('prioridade')">
                        <p>processada</p>
                    </td>
                    <td class="col-some fase pri-processada" v-else>
                        <p>processada</p>
                    </td>
                    

                    <td class="col-aparece prioridade pri-baixa" v-if="dado.prioridade == 1 && ArrayColunas.includes('prioridade')">
                        <p>baixa</p>
                    </td>
                    <td class="col-some prioridade pri-baixa" v-else>
                        <p>baixa</p>
                    </td>


                    <td class="col-aparece prioridade pri-media" v-if="dado.prioridade == 2 && ArrayColunas.includes('prioridade')">
                        <p>media</p>
                    </td>
                    <td class="col-some prioridade pri-media" v-else>
                        <p>media</p>
                    </td>


                    <td class="col-aparece prioridade pri-alta" v-if="dado.prioridade >= 3 && ArrayColunas.includes('prioridade')">
                        <p>alta</p>
                    </td>
                    <td class="col-some prioridade pri-alta" v-else>
                        <p>alta</p>
                    </td>


                    <td class="col-aparece" v-if="ArrayColunas.includes('edital')">{{dado.nu_edital}}</td>
                    <td v-else class="col-some">{{dado.nu_edital}}</td>

                    <td class="col-aparece" v-if="ArrayColunas.includes('data_abertura')">{{formatDate(dado.data_abertura)}}</td>
                    <td v-else class="col-some">{{formatDate(dado.data_abertura)}}</td>

                    <td class="col-aparece" v-if="ArrayColunas.includes('created_at')">{{formatDate(dado.created_at)}}</td>
                    <td v-else class="col-some">{{formatDate(dado.created_at)}}</td>

                </tr>
            </tbody>
        </table>

        <div class="bottom-table">
            <div class="controlador-de-pagina" v-if="totalDePaginas<4" v-for="(item, index) in totalDePaginas" @click="()=>{paginaAtual = index}">
                <button>{{ index + 1 }}</button>
            </div>

            <div class="controlador-de-pagina" v-else="totalDePaginas>=4">

                <div class="btn-controlador " v-on:click="() => { if (paginaAtual > 0) {paginaAtual--} }">
                    <svg class="controlador-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" /></svg>
                </div>

                <div class="btn-controlador" @click="()=>{paginaAtual = 0}" v-if=" paginaAtual > 0">{{1}}</div>

                <div class=" btn-controlador retcencias" v-if="paginaAtual > 1">...</div>

                <div class="btn-controlador pagina-atual-btn" @click="()=>{paginaAtual = paginaAtual}" v-if="props.dados[Iniciotabela]">{{paginaAtual + 1}} </div>

                <div class="btn-controlador retcencias" v-if="totalDePaginas - paginaAtual > 2">...</div>

                <div class="btn-controlador" @click="()=>{ paginaAtual = totalDePaginas -1}" v-if="paginaAtual + 1 != totalDePaginas">{{totalDePaginas}} </div>

                <div class="btn-controlador" v-on:click="() => {   if (paginaAtual + 1 < totalDePaginas ) {paginaAtual++}  }">
                    <svg class="controlador-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" /></svg>
                </div>
            </div>
        </div>
    </div>

</div>
</template>