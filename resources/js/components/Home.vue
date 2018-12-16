<template>
  <div class="home">
    <h1>Home</h1>
    <template v-if="isLoggedIn">
      <p>
        <span>現在のユーザー：</span>
        <span>{{ userName }}</span>
      </p>
      <button @click="logOut" style="margin-bottom: 1rem;">ログアウト</button>
      <form @submit.prevent="submit">
        <div class="formItem">
          <span>メッセージ</span>
          <br>
          <textarea v-model="message" required></textarea>
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
      <form @submit.prevent="logIn">
        <div class="form-items">
          <span>メールアドレス</span>
          <br>
          <input type="email" v-model="auth.email" required>
        </div>
        <div class="formItem">
          <span>パスワード</span>
          <br>
          <input type="password" v-model="auth.password" required>
        </div>
        <button type="submit">ログイン</button>
      </form>
    </template>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import http from '../utils/http';
export default {
  data: function() {
    return {
      message: '',
      posts: {},
      auth: {}
    }
  },
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    }),
    ...mapState('user', {
      userName: state => state.name,
    })
  },
  methods: {
    ...mapActions('auth', {
      handleLogIn: 'logIn',
      logOut: 'logOut'
    }),
    ...mapActions('user', [
      'getUserInfo'
    ]),
    submit: async function() {
      const params = { message: this.message }
      const res = await http.post('/api/posts', params);
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
      await this.getUserInfo();
      const res = await http.get('/api/posts');
      if (res.status === 200 && res.data) {
        this.posts = res.data;
      }
    },
    logIn: async function() {
      await this.handleLogIn(this.auth);
      if (this.isLoggedIn) {
        await this.fetch();
      }
    },
  },
  mounted: async function() {
    if (this.isLoggedIn) {
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
