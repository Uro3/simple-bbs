<template lang="pug">
  div#thread-list
    v-list
      template(v-for="(thread, index) in threads")
        v-list-tile(:key="index" @click="move")
          v-list-tile-content
            v-list-tile-title.title {{ thread.title }}
            v-list-tile-sub-title.font-italic {{ thread.description }}
        v-divider.py-1(v-if="index + 1 < threads.length")
</template>

<script>
import http from '../utils/http';
export default {
  data: function() {
    return {
      threads: [],
    }
  },
  methods: {
    fetch: async function() {
      const { status, data } = await http.get('/api/threads');
      if (status === 200 && data) {
        this.threads = data;
      }
    },
    move: function() {
      console.log('move');
    }
  },
  created: async function() {
    await this.fetch();
  }
}
</script>
