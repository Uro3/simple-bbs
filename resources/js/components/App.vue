<template lang="pug">
  div#root
    v-app
      navigation(:show="showNav" @change="toggleNav($event)")
      toolbar(@draw="showNav = !showNav")
      router-view.container
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Navigation from './Navigation.vue';
import Toolbar from './Toolbar.vue';
export default {
  components: {
    Navigation,
    Toolbar
  },
  data: function() {
    return {
      showNav: false
    }
  },
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    }),
    ...mapState('user', {
      userName: state => state.name,
    })
  },
  methods: {
    ...mapActions('user', [
      'getUserInfo'
    ]),
    toggleNav: function(event) {
      this.showNav = event;
    }
  },
  created: function() {
    if (!this.isLoggedIn) {
      if (!/^\/(signup|login)$/.test(window.location.pathname)) {
        this.$router.push('/login');
      }
    } else {
      if (!this.userName) {
        this.getUserInfo();
      }
      if (/^\/(signup|login)$/.test(window.location.pathname)) {
        this.$router.push('/home');
      }
    }
  }
}
</script>
