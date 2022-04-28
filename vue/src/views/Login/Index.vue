<template>
<v-layout>
  <div class="col-lg-5 col-12">
      <div id="auth-left">
          <div class="auth-logo" style="margin-bottom:2rem;">
              <h1 class="text-secondary">Simba Lite</h1>
              <!-- <img src="http://172.21.1.19/pak/public/images/logo/logo.png" alt="Logo"> -->
          </div>
          <h1 style="margin-bottom:1rem;">Log in.</h1>
          <p class="text-danger" v-show="errormessage" >{{ errormessage }}</p>
          <form @submit.prevent="login(user)">
              <div class="form-group position-relative has-icon-left mb-4">
                  <input v-model="user.username" type="text" placeholder="Username" class="form-control form-control-xl"
                    :class="{'is-invalid': errormessage}"
                    required autofocus>
                  <div class="form-control-icon">
                      <i class="bi bi-person"></i>
                  </div>
              </div>
              <div class="form-group position-relative has-icon-left mb-4">
                  <input v-model="user.password" type="password" placeholder="Password" class="form-control form-control-xl"
                    :class="{'is-invalid': errormessage}"
                    >
                  <div class="form-control-icon">
                      <i class="bi bi-shield-lock"></i>
                  </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Log in</button>
          </form>
      </div>
  </div>
  <div class="col-lg-7 d-none d-lg-block">
      <div id="auth-right">

      </div>
  </div>
</v-layout>
</template>

<script>
/* ============
 * Login Index Page
 * ============
 *
 * Page where the user can login.
 */

import VLayout from '@/layouts/Minimal.vue';
import VCard from '@/components/Card.vue';

import '@/assets/css/pages/auth.css';

export default {
  /**
   * The name of the page.
   */
  name: 'LoginIndex',

  /**
   * The components the page can use.
   */
  components: {
    VLayout,
    VCard,
  },

  /**
   * The data that can be used by the page.
   *
   * @returns {Object} The view-model data.
   */
  data() {
    return {
      user: {
        username: null,
        password: null,
      },
      errormessage : null,
    };
  },

  /**
   * The methods the page can use.
   */
  methods: {
    /**
     * Will log the user in.
     *
     * @param {Object} user The user to be logged in.
     */
    async login(user) {
      this.errormessage=null;
      this.$store.dispatch('auth/login', user).catch(e=>this.errormessage="username dan password tidak selaras");
    },
  },
};
</script>
