<template lang="pug">
  div#thread
    v-card()
      v-card-title.headline {{ thread.title }}
      v-card-text.body-2 {{ thread.description }}
    v-container(fluid)
      v-layout( justify-space-between row)
        v-flex(xs3)
          v-btn(color="primary" @click="move()")
            span スレッド一覧
        v-flex(xs3)
          v-btn(color="primary" @click="showForm = !showForm")
            span(v-if="!showForm") 新規投稿
            span(v-else) 閉じる
    template(v-if="showForm")
      v-card(color="indigo lighten-5" transition="slide-y-transition")
        v-card-text
          post-form(:threadId="threadId" @success="getPosts()")
    v-list.mt-5
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
      showForm: false
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
      const params = { thread_id: this.threadId }
      const { status, data } = await http.get('/api/posts', params);
      if (status === 200 && data) {
        this.posts = data;
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
  created: async function() {
    await this.fetch();
  }
}
</script>
