require('./bootstrap');

window.Vue = require('vue');

import router from './router';
import http from './services/http.js';

const app = new Vue({
    router,
    el: '#app',
    created () {
      http.init()
    },
    render: h => h(require('./app.vue')),
});