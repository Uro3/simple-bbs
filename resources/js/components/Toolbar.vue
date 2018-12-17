<template lang="pug">
  v-toolbar(color="indigo" dark)
    v-toolbar-title SIMPLE BBS
    v-spacer
    v-menu(v-if="isLoggedIn" offset-y)
      v-icon(slot="activator" large) account_circle
      v-list
        v-list-tile(@click="")
          v-list-tile-title 設定
        v-list-tile(@click="logOut")
          v-list-tile-title ログアウト
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
  name: 'toolbar',
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

<style lang="css">
</style>
