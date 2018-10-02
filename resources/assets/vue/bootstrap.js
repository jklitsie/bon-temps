
// Lodash
window._ = require('lodash');

// jQuery
try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap-sass');
} catch (e) {}

// Vue
window.Vue = require('vue');
import 'es6-promise/auto';

// Axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// CSRF
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}

// Echo
// import Echo from "laravel-echo"
// window.Echo = new Echo({
//     // authEndpoint: '//ws.nl010vm111.nr1net.com/broadcasting/auth',
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ":6001",
//     auth: {
//         headers: {
//             Authorization: 'Bearer ' + '7ea7bd026bb2905c',
//         },
//     },
// });
