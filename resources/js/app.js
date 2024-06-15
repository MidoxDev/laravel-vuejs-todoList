import './bootstrap';
import { createApp } from 'vue';
import Index from './views/todos/Index.vue';

createApp({})
  .component('Index', Index)
  .mount('#app')
