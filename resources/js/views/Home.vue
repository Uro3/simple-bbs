<template lang="pug">
  div#home
    div.text-xs-center
      v-btn(large color="primary" @click="move('/thread-list')") スレッド一覧
    div.text-xs-center
      v-btn(large color="primary" @click="showDialog = true") スレッド作成
    thread-form-dialog(:show='showDialog' @close='showDialog = false')
</template>

<script>
import ThreadFormDialog from '../components/ThreadFormDialog.vue';
export default {
  components: {
    ThreadFormDialog
  },
  data: function() {
    return {
      showDialog: false
    }
  },
  methods: {
    move: function(path) {
      this.$router.push(path)
    }
  }
}
</script>
