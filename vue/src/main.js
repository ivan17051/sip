/* ============
 * Main File
 * ============
 *
 * Will initialize the application.
 */

import Vue from 'vue';

/* ============
 * Plugins
 * ============
 *
 * Import and bootstrap the plugins.
 */

import './plugins/vuex';
import './plugins/axios';
import { i18n } from './plugins/vue-i18n';
import { router } from './plugins/vue-router';
import './plugins/vuex-router-sync';
// import './plugins/bootstrap';
import './plugins/font-awesome';
import './plugins/register-service-worker';

/* ============
 * Styling
 * ============
 *
 * Import the application styling.
 * Stylus is used for this boilerplate.
 *
 * If you don't want to use Stylus, that's fine!
 * Replace the stylus directory with the CSS preprocessor you want.
 * Import the entry point here & install the webpack loader.
 *
 * It's that easy...
 *
 * http://stylus-lang.com/
 */

import './assets/stylus/app.styl';
import './assets/css/material-dashboard.css';

/* ============
 * Styling
 * ============
 * 
 */

// window.$ = window.jQuery = require('jquery');
import jQuery from 'jquery';
window.$ = jQuery;
Object.defineProperty(Vue.prototype, '$jQuery', { value: jQuery });

 import './assets/js/core/bootstrap-material-design.min.js';
 import './assets/js/plugins/perfect-scrollbar.min.js';
 import './assets/js/material-dashboard.js?v=2.2.2';

/* ============
 * Main App
 * ============
 *
 * Last but not least, we import the main application.
 */

import App from './App.vue';
import store from './store';

Vue.config.productionTip = false;

store.dispatch('auth/check');

/* eslint-disable no-new */
new Vue({
  /**
   * Bind the Vue instance to the HTML.
   */
  el: '#app',

  /**
   * The localization plugin.
   */
  i18n,

  /**
   * The router.
   */
  router,

  /**
   * The Vuex store.
   */
  store,

  /**
   * Will render the application.
   *
   * @param {Function} h Will create an element.
   */
  render: (h) => h(App),
});
