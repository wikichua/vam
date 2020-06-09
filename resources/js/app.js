require('./bootstrap');

window.Vue = require('vue');

require('./plugins/filter');
require('./plugins/bootstrapVue');
require('./plugins/vForm');
require('./plugins/popper');
require('./plugins/portalvue');
require('./plugins/sweetAlert2');
require('./plugins/progressbar');
require('./plugins/vueSelect');
require('./plugins/vueLoading');
require('./plugins/vue2editor');
require('./plugins/ziggy');
require('./plugins/permissions');
require('./plugins/settings');
require('./plugins/customEvents');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router';
import store from './vuexStore';
import { routes } from './routes';
Vue.use(VueRouter);
const router = new VueRouter({
    routes,
    mode: 'history',
});
const app = new Vue({
    el: '#app',
    router,
    store,
    data() {
        return {

        };
    },
    created() {
        Fire.$on('responseHandling', (response) => {
            if (response.data.hasOwnProperty('message')) {
                Toast.fire({
                    icon: 'success',
                    title: response.data.message
                });
            }
            if (response.data.hasOwnProperty('redirectTo')) {
                this.$router.push(response.data.redirectTo);
            }
            if (response.data.hasOwnProperty('reloadPage')) {
                this.$router.go();
            }
        });
        Fire.$on('reloadDataEvent', (table) => {
            table.refresh();
        });
    },
    methods: {
        goBack() {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        }
    }
});

/*
Notes.
Once have a new routes in laravel, run php artisan ziggy:generate

 */
