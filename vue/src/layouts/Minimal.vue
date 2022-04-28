<template>
  <div>
    <v-loading></v-loading>
    <div id="auth">
      <div class="row h-100">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
/* ============
 * Minimal Layout
 * ============
 *
 * Used for the register and login pages.
 *
 * Layouts are used to store a lot of shared code.
 * This way the app stays clean.
 */
import VLoading from '@/components/Loading.vue';

export default {
  /**
   * The name of the layout.
   */
  name: 'MinimalLayout',
  components: {
    VLoading,
  },
};
</script>
