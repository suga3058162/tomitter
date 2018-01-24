require('./bootstrap');

window.Vue = require('vue');

import http from './services/http.js';

const app = new Vue({
    el: '#app',
    created () {
      http.init()
    },
    render: h => h(require('./app.vue')),
});