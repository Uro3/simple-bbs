<template lang="pug">
v-navigation-drawer(v-model="drawer" fixed app)
  v-list(dense)
    template(v-if="isLoggedIn")
      v-list-tile(@click="move('/home')")
        v-list-tile-action
          v-list-tile-content
            v-list-tile-title ホーム
      v-list-tile(@click="move('/thread-list')")
        v-list-tile-action
          v-list-tile-content
            v-list-tile-title スレッド一覧
      v-divider.py-1
      v-list-tile(@click="logOut")
        v-list-tile-action
          v-list-tile-content
            v-list-tile-title ログアウト
    template(v-else)
      v-list-tile(@click="move('/login')")
        v-list-tile-action
          v-list-tile-content
            v-list-tile-title ログイン
      v-list-tile(@click="move('/signup')")
        v-list-tile-action
          v-list-tile-content
            v-list-tile-title サインアップ
</template>
<script>
import { mapState, mapActions } from 'vuex';
export default {
  name: 'navigation',
  props: {
    show: {
      type: Boolean,
      required: true
    }
  },
  data: function() {
    return {
      drawer: false
    }
  },
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    })
  },
  watch: {
    show: function(value) {
      this.drawer = value;
    },
    drawer: function(value) {
      this.$emit('change', value)
    }
  },
  methods: {
    ...mapActions('auth', {
      logOut: 'logOut'
    }),
    move: function(path) {
      this.$router.push(path);
    }
  },
  mounted: function() {
    this.drawer = this.show;
  }
}
</script>
