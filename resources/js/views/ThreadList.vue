<template lang="pug">
  div#thread-list
    h2 スレッド一覧
    v-container.text-xs-center(fluid)
      v-layout( justify-space-between row)
        v-flex(xs3)
          v-btn(color="primary" @click="moveHome()")
            span ホーム
        v-flex(xs3)
          v-btn(color="primary" @click="showForm = !showForm")
            span(v-if="!showForm") 新規作成
            span(v-else) 閉じる
    template(v-if="showForm")
      v-card(color="indigo lighten-5" transition="slide-y-transition")
        v-card-text
          thread-form(:threadId="threadId" @success="fetch()")
    div.mt-5.text-xs-center
      v-pagination(
        v-model="currentPage"
        :length="lastPage"
        :total-visible="7"
      )
    v-list.mt-3
      template(v-for="(thread, index) in threads")
        v-list-tile(:key="index" @click="moveThread(thread.id)")
          v-list-tile-content
            v-list-tile-title.title {{ thread.title }}
            v-list-tile-sub-title.font-italic {{ thread.description }}
        v-divider.py-1(v-if="index + 1 < threads.length")
</template>

<script>
import http from '../utils/http';
import ThreadForm from '../components/ThreadForm';
export default {
  components: {
    ThreadForm
  },
  data: function() {
    return {
      threads: [],
      showForm: false,
      currentPage: 1,
      lastPage: 1
    }
  },
  methods: {
    fetch: async function() {
      const params = { page: this.currentPage }
      const { status, data } = await http.get('/api/threads', params);
      if (status === 200 && data) {
        this.threads = data.data;
        this.lastPage = data.last_page;
      }
    },
    moveHome: function() {
      this.$router.push('/home');
    },
    moveThread: function(id) {
      this.$router.push(`/thread/${id}`);
    }
  },
  watch: {
    currentPage: function() {
      this.fetch()
    }
  },
  created: async function() {
    await this.fetch();
  }
}
</script>
