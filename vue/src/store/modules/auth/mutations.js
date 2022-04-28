/* ============
 * Mutations for the auth module
 * ============
 *
 * The mutations that are available on the
 * account module.
 */

import Vue from 'vue';
import {
  CHECK,
  REGISTER,
  LOGIN,
  LOGOUT,
} from './mutation-types';

/* eslint-disable no-param-reassign */
export default {
  [CHECK](state) {
    state.authenticated = !!localStorage.getItem('id_token');
    if (state.authenticated) {
      Vue.$http.defaults.headers.common.Authorization = `Bearer ${localStorage.getItem('id_token')}`;
    }
  },

  [REGISTER]() {
    //
  },

  [LOGIN](state, data) {
    state.authenticated = true;
    localStorage.setItem('id_token', data.access_token);
    Vue.$http.defaults.headers.common.Authorization = `Bearer ${data.access_token}`;
    Vue.$http.interceptors.request.use((config) => {
      config.params = config.params || {};
      config.params['api_token'] = data.access_token;
      return config;
    });
  },

  [LOGOUT](state) {
    state.authenticated = false;
    localStorage.removeItem('id_token');
    Vue.$http.defaults.headers.common.Authorization = '';
    console.log(Vue.$http.defaults.params);
  },
};
