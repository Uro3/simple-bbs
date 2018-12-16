<template lang="pug">
  div#home
    p Here is home.
    v-btn(outline color="indigo" @click="logOut") ログアウト
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    })
  },
  watch: {
    isLoggedIn: function(value) {
      if (!value) {
        this.$router.push('/login');
      }
    }
  },
  methods: {
    ...mapActions('auth', {
      logOut: 'logOut'
    }),
  }
}
</script>
