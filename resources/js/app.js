/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('chat-window', require('./components/chat/ChatWindow.vue').default);

// following could become local components inside chat-window
Vue.component('contact-book', require('./components/chat/contact-book/Contact').default);
Vue.component('conversation', require('./components/chat/contact-book/Conversation'));
Vue.component('message-area', require('./components/chat/message-area/MessageArea').default);

// following can be a local component inside contact-book/conversation
Vue.component('search', require('./components/chat/contact-book/Search'));

// following can become local component inside message-area
Vue.component('header', require('./components/chat/message-area/Header'));
Vue.component('messages', require('./components/chat/message-area/Message'));
Vue.component('footer', require('./components/chat/message-area/Footer'));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
