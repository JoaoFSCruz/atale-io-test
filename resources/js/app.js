require('./bootstrap');

import { createApp } from 'vue';
import RegisterForm from './components/RegisterForm';
import Flash from './components/Flash';

createApp({
    components: {
        RegisterForm,
        Flash
    }
}).mount("#app");
