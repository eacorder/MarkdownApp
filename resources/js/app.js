require('./bootstrap');
import Vue from 'vue'
import App from './vue/app.vue'
import moment from 'moment';
import Toaster from 'v-toaster'
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'


window.Event = new Vue();
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY')
    }
});

const app = new Vue({
    el: '#app',
    components: {App}
})