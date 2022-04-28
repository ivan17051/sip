<template>
  <div class="position-absolute loading-container" v-show="$store.state.loading.loading">
    <img :src="icon" alt="loading.." width="112px" >
  </div>
</template>

<script>
import loadingIcon from '@/assets/svg/loading.svg';

export default {
  /**
   * The name of the component.
   */
  name: 'Loading',

	data() {
    return {
			icon: loadingIcon,
    };
  },
};
</script>
