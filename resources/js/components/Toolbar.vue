<template lang="pug">
  v-toolbar(color="indigo" dark)
    v-toolbar-side-icon(@click.stop="$emit('draw')")
    v-toolbar-title.font-weight-black 弐番
    v-spacer
    v-toolbar-title(v-if="isLoggedIn") {{ userName }}
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
  name: 'toolbar',
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    }),
    ...mapState('user', {
      userName: state => state.name,
    })
  },
  watch: {
    isLoggedIn: function(value) {
      if (!value) {
        this.$router.push('/login');
      }
    }
  }
}
</script>

<style lang="css">
</style>
