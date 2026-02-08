/**
 * Load project dependencies
 * Bootstrap, Popper, Axios, and other JS libraries.
 */

require('./bootstrap');

/**
 * If you are using Bootstrap's JavaScript components (modals, dropdowns, 
 * off-canvas, navbar toggle, etc.), initialize them below.
 */
try {
    window.bootstrap = require('bootstrap');
} catch (e) {
    console.error("Bootstrap failed to load:", e);
}

/**
 * If you ARE NOT using Vue, remove all Vue related code.
 * The code below has been removed because it is deprecated.
 *
 * If you want Vue later, you can reinstall it.
 */

// window.Vue = require('vue').default;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// const app = new Vue({
//     el: '#app',
// });

/**
 * You may add your own custom scripts here.
 * Example: for menu toggle, sidebar collapse, etc.
 */

// Example: Navbar mobile toggle
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');

    if (menuToggle && menu) {
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
});
