<template lang="pug">
  div#thread
    v-card
      v-card-title.headline {{ thread.title }}
      v-card-text.body-2 {{ thread.description }}
    v-container.text-xs-center(fluid)
      v-layout( justify-space-between row)
        v-flex(xs4)
          v-btn(color="primary" @click="move")
            span スレッド一覧
        v-flex(xs4)
          v-btn(color="primary" @click="showForm = !showForm")
            span(v-if="!showForm") 新規投稿
            span(v-else) 閉じる
    template(v-if="showForm")
      v-card.mb-5(color="indigo lighten-5" transition="slide-y-transition")
        v-card-text
          post-form(:threadId="threadId" @success="getPosts()")
    div.text-xs-center
      v-pagination(
        v-model="currentPage"
        :length="lastPage"
        :total-visible="7"
      )
    v-list.mt-3
      template(v-for="(post, index) in posts")
        v-list-tile(:key="index")
          v-list-tile-content
            v-list-tile-sub-title 名前: {{ post.name }}
            v-list-tile-sub-title.text--primary {{ post.message }}
        v-divider.py-1(v-if="index + 1 < posts.length")
</template>

<script>
import http from '../utils/http';
import PostForm from '../components/PostForm.vue';
export default {
  components: {
    PostForm
  },
  data: function() {
    return {
      threadId: this.$route.params.threadId,
      thread: {},
      posts: [],
      showForm: false,
      currentPage: 1,
      lastPage: 1
    }
  },
  methods: {
    getThread: async function() {
      const { status, data } = await http.get(`/api/threads/${this.threadId}`);
      if (status === 200 && data) {
        this.thread = data;
      }
    },
    getPosts: async function() {
      const params = {
        thread_id: this.threadId,
        page: this.currentPage
      }
      const { status, data } = await http.get('/api/posts', params);
      if (status === 200 && data) {
        this.posts = data.data;
        this.lastPage = data.last_page;
      }
    },
    fetch: async function() {
      await this.getThread();
      await this.getPosts();
    },
    move: function(id) {
      this.$router.push(`/thread-list`);
    }
  },
  watch: {
    currentPage: function() {
      this.getPosts()
    }
  },
  created: async function() {
    await this.fetch();
  }
}
</script>
