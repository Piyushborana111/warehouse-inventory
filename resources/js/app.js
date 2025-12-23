import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';

axios.defaults.baseURL = '/api';
window.axios = axios;
// Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';

// Bootstrap JS (dropdown, modal etc.)
import 'bootstrap';

createApp(App)
    .use(router)
    .mount('#app');
