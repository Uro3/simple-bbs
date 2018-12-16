<template lang="pug">
  div#root
    v-app
      toolbar
      router-view.container
</template>

<script>
import { mapState } from 'vuex';
import Toolbar from './Toolbar.vue';
export default {
  components: {
    Toolbar
  },
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    })
  },
  created: function() {
    if (!this.isLoggedIn) {
      if (!/^\/(signup|login)$/.test(window.location.pathname)) {
        this.$router.push('/login');
      }
    }
  }
}
</script>
