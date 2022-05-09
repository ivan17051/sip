<template>
  <div>
    <v-loading></v-loading>
    <div class="wrapper ">
    <!-- Sidebar -->
      
    <!-- End of Sidebar -->
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
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
              <li class="nav-item">
                <a class="nav-link" href="">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Dashboard
                  </p>
                </a>
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Profil
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <!-- <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div> -->
                  <a class="dropdown-item" href=""
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
                  <form id="logout-form" action="" method="POST" style="display: none;">
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="content">
          <slot/>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
          </nav>
          <div class="copyright float-right">
            &copy;
            2022, made with <i class="material-icons">favorite</i> by IT DKK Surabaya.
          </div>
        </div>
      </footer>
    </div>
  </div>
  </div>
</template>

<script>
  /* ============
   * Default Layout
   * ============
   *
   * Used for the home and account pages.
   *
   * Layouts are used to store a lot of shared code.
   * This way the app stays clean.
   */
  import VLoading from '@/components/Loading.vue';

  export default {
    /**
     * The name of the layout.
     */
    name: 'DefaultLayout',
    components: {
      VLoading,
    },
    /**
     * The data that can be used by the page.
     *
     * @returns {Object} The view-model data.
     */
    data() {
      return {
        menuCollapsed: false,
      };
    },

    /**
     * The methods that the layout can use.
     */
    methods: {
      /**
       * Will log the user out.
       */
      logout() {
        this.$store.dispatch('auth/logout');
      },

      /**
       * Will toggle the menu.
       */
      toggleMenu() {
        this.menuCollapsed = !this.menuCollapsed;
      },
    },
  };

</script>
