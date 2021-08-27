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
Vue.component('frm-alumno', require('./components/frmAlumno.vue').default);
Vue.component('frm-curso', require('./components/frmCurso.vue').default);
Vue.component('frm-materia', require('./components/frmMateria.vue').default);
Vue.component('frm-gestion', require('./components/frmGestion.vue').default);
Vue.component('frm-apoderado', require('./components/frmApoderado.vue').default);
Vue.component('frm-secretaria', require('./components/frmSecretaria.vue').default);
Vue.component('frm-profesor', require('./components/frmProfesor.vue').default);
Vue.component('frm-inscripcion', require('./components/frmInscripcion.vue').default);
Vue.component('frm-pago-mensual', require('./components/frmPagoMensual.vue').default);
Vue.component('frm-factura', require('./components/frmFactura.vue').default);
Vue.component('frm-gestion-curso', require('./components/frmGestionCurso.vue').default);
Vue.component('frm-curso-materia', require('./components/frmCursoMateria.vue').default);
Vue.component('frm-curso-paralelo', require('./components/frmCursoParalelo.vue').default);
Vue.component('frm-alumno-materia', require('./components/frmAlumnoMateria.vue').default);
Vue.component('frm-boletin', require('./components/frmBoletin.vue').default);
Vue.component('frm-usuario', require('./components/frmUsuario.vue').default);
Vue.component('frm-asistencia', require('./components/frmAsistencia.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data : {
        menu : 0
    }
});
