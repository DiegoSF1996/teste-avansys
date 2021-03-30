import Inicio from './viewsVue/inicio';


export default{
    mode: 'history',
    routes: [
     
        {
            path: '/',
            component: Inicio,
            name: "Inicio"
        }
          
    ]
}