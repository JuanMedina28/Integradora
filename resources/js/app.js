/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('regist-component', require('./components/RegistroDualComponent.vue').default);
Vue.component('servicios-component', require('./components/ServiciosComponent.vue').default);
Vue.component('inicio-component', require('./components/InicioComponent.vue').default);
Vue.component('pedidos-component', require('./components/PedidosComponent.vue').default);
Vue.component('profile-component', require('./components/ProfileComponent.vue').default);
Vue.component('usuarios-component', require('./components/UsuariosComponent.vue').default);
Vue.component('negocios-component', require('./components/NegociosComponent.vue').default);
Vue.component('inicioroot-component', require('./components/InicioRootComponent.vue').default);
Vue.component('carrito-component', require('./components/CarritoComponent.vue').default);
Vue.component('historial-component', require('./components/HistorialComponent.vue').default);
Vue.component('solicitud-component', require('./components/SolicitudesComponent.vue').default);
/**
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app_party',
});
