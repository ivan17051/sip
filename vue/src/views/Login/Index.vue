<template>
<v-layout>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="javascript:;">SIP SDMK</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item  active ">
            <a href="" class="nav-link">
              <i class="material-icons">fingerprint</i>
              Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter"  filter-color="black" style="background-size: cover; background-position: bottom center;" :style="styles.image">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container" >
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form @submit.prevent="login(user)">
              <div class="card card-login card-hidden">
                <div class="card-header card-header-rose text-center">
                  <h4 class="card-title">Login</h4>
                  <div class="social-line">
                  </div>
                </div>
                <div class="card-body ">
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">face</i>
                        </span>
                      </div>
                      <div style="flex:1;">
                        <input type="text" id="username" name="username" v-model="user.username" :class="{'error': errormessage}" required autofocus class="form-control " placeholder="Username...">
                      </div>
                    </div>
                  </span>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <div style="flex:1;">
                        <input id="password" type="password" class="form-control" placeholder="Password..." name="password" v-model="user.password" :class="{'error': errormessage}" required>
                      </div>
                    </div>
                  </span>
                </div>
                <div class="card-footer justify-content-center">
                  <button type="submit" class="btn btn-rose btn-link btn-lg">LOGIN</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container">
          <div class="copyright">
            &copy;
            2022, made with <i class="material-icons">favorite</i> by IT DKK Surabaya
            <!-- <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web. -->
          </div>
        </div>
      </footer>
    </div>
  </div>
</v-layout>
</template>

<script>
$(document).ready(function() {
  md.checkFullPageBackgroundImage();
  setTimeout(function() {
    // after 1000 ms we add the class animated to the login/register card
    $('.card').removeClass('card-hidden');
  }, 700);
});

/* ============
 * Login Index Page
 * ============
 *
 * Page where the user can login.
 */

import VLayout from '@/layouts/Minimal.vue';
import VCard from '@/components/Card.vue';

import bgimage from "@/assets/img/bg.jpg";

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
      styles:{
        image: { backgroundImage: 'url('+bgimage+')'}
      }
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
