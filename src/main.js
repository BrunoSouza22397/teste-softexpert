import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHashHistory } from 'vue-router'

import "bootstrap/dist/css/bootstrap.min.css"
import './assets/main.css'

//route components
import Home from './components/Home.vue';
import Produtos from './components/Produtos.vue';
import CadastroProdutos from './components/CadastroProdutos.vue';
import CadastroTipos from './components/CadastroTipos.vue';

//defining routes
const routes = [
    {
        path: '/', 
        component: Home,
    },
    {
        path: '/produtos',
        component: Produtos,
        children: [
            {
                path: '/cad-produtos',
                component: CadastroProdutos,
            },
            {
                path: '/cad-tipos',
                component: CadastroTipos,
            }
        ]
    }
];

//router instance
const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

createApp(App).use(router).mount('#app')
