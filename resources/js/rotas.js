import cad_descricao from './viewsVue/cad_descricao';
import cad_operadora from './viewsVue/cad_operadora';
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
            component: cad_descricao
        },
        {
            path: '/cad_operadora',
            component: cad_operadora,
            name: "cad_operadora"
        }
          
    ]
}