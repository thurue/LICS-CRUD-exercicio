import '../css/app.css'
import '../../public/css/index.css'
import { createApp, createRenderer } from 'vue';

const app = createApp({});

import ExampleComponent from './pages/ExampleComponent.vue';

app.component('example-component', ExampleComponent);

app.mount('#app');


const Card = createApp({});

import CardComponent from './pages/Cards.vue';

Card.component('card-component', CardComponent);

Card.mount('#card-app');


const lics = createApp({});

import licComponent from './pages/Lics.vue';

lics.component('lic-component', licComponent);

lics.mount('#lics-app');


const Add = createApp({});

import AddComponent from './pages/Add.vue';

Add.component('add-component', AddComponent);

Add.mount('#add-app');


const edit = createApp({});

import EditComponent from './pages/Edit.vue';

edit.component('edit-component', EditComponent);

edit.mount('#edit-app');
