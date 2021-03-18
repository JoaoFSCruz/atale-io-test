require('./bootstrap');

import { createApp } from 'vue';
import MainForm from './components/MainForm'
import RegisterForm from './components/RegisterForm';

createApp({
    components: {
        MainForm,
        RegisterForm
    }
}).mount("#app")

