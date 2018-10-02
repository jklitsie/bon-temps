require('./bootstrap');

// import App from './App';
// import router from './router.js';
// import store from './store'

Vue.config.productionTip = false;
Vue.config.debug = true;

Vue.filter('time', timestamp => {
    return new Date(timestamp).toLocaleTimeString()
})

new Vue({
    el: '#app',
    components: {  }
});
