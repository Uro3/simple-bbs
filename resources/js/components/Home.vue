<template>
  <div class="home">
    <h1>Home</h1>
    <form @submit.prevent="submit">
      <div class="form-items">
        <span>名前</span>
        <br>
        <input v-model="form.name" required>
      </div>
      <div class="formItem">
        <span>メッセージ</span>
        <br>
        <textarea v-model="form.message" required></textarea>
      </div>
      <button type="submit">投稿</button>
    </form>
    <hr>
    <ul>
      <li v-for="(post, index) in posts" :key="index">
        <div class="post-item">ID：{{ post.id }}</div>
        <div class="post-item">名前：{{ post.name }}</div>
        <div class="post-item">メッセージ：{{ post.message }}</div>
        <button type="button" @click="remove(post.id)">削除</button>
      </li>
    </ul>
  </div>
</template>

<script>
import http from '../utils/http';
export default {
  data: function() {
    return {
      form: {},
      posts: {}
    }
  },
  methods: {
    submit: async function() {
      const res = await http.post('posts', this.form);
      if (res.status === 200) {
        await this.fetch();
        this.form = {};
      }
    },
    remove: async function(id) {
      const res = await http.delete(`posts/${id}`);
      if (res.status === 200) {
        await this.fetch();
      }
    },
    fetch: async function() {
      const res = await http.get('posts');
      console.log(res);
      if (res.status === 200 && res.data) {
        this.posts = res.data;
      }
    }
  },
  mounted: async function() {
    await this.fetch();
  }
}
</script>

<style lang="scss" scoped>
ul {
  list-style-type: none;
  li + li {
    margin-top: 1rem;
  }
}
</style>
