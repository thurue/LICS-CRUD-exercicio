/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import '../css/app.css'
import '../../public/css/index.css'
import { createApp } from 'vue';
// lics/resources/js/app.js
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';

app.component('example-component', ExampleComponent);

app.mount('#app');

const Card = createApp({});

import CardComponent from './components/Cards.vue';

Card.component('card-component', CardComponent);

Card.mount('#card-app');

const Add = createApp({});

import AddComponent from './components/Add.vue';

Add.component('add-component', AddComponent);

Add.mount('#add-app');
