<template>
  <div class="home">
    <h1>Home</h1>
    <template v-if="isLoggedIn">
      <button @click="logout" style="margin-bottom: 1rem;">ログアウト</button>
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
    </template>
    <template v-else>
      <form @submit.prevent="login">
        <div class="form-items">
          <span>メールアドレス</span>
          <br>
          <input type="email" v-model="email" required>
        </div>
        <div class="formItem">
          <span>パスワード</span>
          <br>
          <input type="password" v-model="password" required>
        </div>
        <button type="submit">ログイン</button>
      </form>
    </template>
  </div>
</template>

<script>
import cookies from 'js-cookie';
import http from '../utils/http';
export default {
  data: function() {
    return {
      form: {},
      posts: {},
      isLoggedIn: false,
      email: '',
      password: ''
    }
  },
  methods: {
    submit: async function() {
      const res = await http.post('/api/posts', this.form);
      if (res.status === 200) {
        await this.fetch();
        this.form = {};
      }
    },
    remove: async function(id) {
      const res = await http.delete(`/api/posts/${id}`);
      if (res.status === 200) {
        await this.fetch();
      }
    },
    fetch: async function() {
      const res = await http.get('/api/posts');
      if (res.status === 200 && res.data) {
        this.posts = res.data;
      }
    },
    login: async function() {
      const res = await http.post('/oauth/token', {
        'client_id': window.Laravel.clientId,
        'client_secret': window.Laravel.clientSecret,
        'username': this.email,
        'password': this.password,
        'grant_type': 'password',
        'scope': ''
      });
      if (res.status === 200 && res.data && res.data.access_token) {
        cookies.set('passport-token', res.data.access_token);
        this.isLoggedIn = true;
        await this.fetch();
      }
    },
    logout: function() {
      cookies.remove('passport-token');
      this.isLoggedIn = false;
    }
  },
  mounted: async function() {
    if (cookies.get('passport-token')) {
      this.isLoggedIn = true;
      await this.fetch();
    }
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
