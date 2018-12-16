<template lang="pug">
  div#root
    v-app
      h1 hello
      router-view.container
</template>

<script>
import { mapState } from 'vuex';
export default {
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
