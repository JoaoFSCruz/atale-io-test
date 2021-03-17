require('./bootstrap');

import { createApp } from 'vue';
import MainForm from './components/MainForm'

createApp({
    components: {
        MainForm
    }
}).mount("#app")

