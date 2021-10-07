/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });



window
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('[name = book_about]')) {
        $('[name = book_about]').summernote();
    }
});
window
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('[name = author_about]')) {
        $('[name = author_about]').summernote();
    }
});



// window
// $(function () {
//     var $posts = $("#posts");
//     var $ul = $("ul.pagination");
//     $ul.hide(); // Prevent the default Laravel paginator from showing, but we need the links...

//     $(".see-more").click(function () {
//         $.get($ul.find("a[rel='next']").attr("href"), function (response) {
//             $posts.append(
//                 $(response).find("#posts").html()
//             );
//         });
//     });
// });

// window
// $(function () {
//     var $comments = $("#comments");
//     var $ul = $("ul.pagination");
//     $ul.hide(); // Prevent the default Laravel paginator from showing, but we need the links...

//     $(".see-more").click(function () {
//         $.get($ul.find("a[rel='next']").attr("href"), function (response) {
//             $comments.append(
//                 $(response).find("#comments").html()
//             );
//         });
//     });
// });