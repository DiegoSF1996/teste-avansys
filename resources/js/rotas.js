import Inicio from './viewsVue/inicio';
import Sobre from './viewsVue/sobre';
import NaoEncontrado from './viewsVue/NaoEncontrado.vue';


export default{
    mode: 'history',
    routes: [
        {
            path: '*',
            component: NaoEncontrado
        },
        {
            path: '/',
            component: Inicio
        },
        {
            path: '/sobre',
            component: Sobre,
            name: "sobre"
        }
          
    ]
}