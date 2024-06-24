import './bootstrap';

import { createApp } from 'vue';
import Index from './views/todos/Index.vue';

import 'bootstrap/dist/css/bootstrap.css';

// Import Bootstrap's JavaScript
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

createApp({})
  .component('Index', Index)
  .mount('#app')
