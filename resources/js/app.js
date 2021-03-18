require('./bootstrap');

import { createApp } from 'vue';
import RegisterForm from './components/RegisterForm';

createApp({
    components: {
        RegisterForm
    }
}).mount("#app")

