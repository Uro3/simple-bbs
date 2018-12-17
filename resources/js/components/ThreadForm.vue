<template lang="pug">
  div.thread-form
    v-form(ref="form" v-model="valid")
      v-text-field(
        v-model="title"
        :rules="rules"
        label="タイトル"
        required
      )
      v-text-field(
        v-model="description"
        :rules="rules"
        label="説明"
        required
      )
      v-btn(:disabled="!valid" @click="submit") 作成
      v-btn(@click="clear") クリア
</template>

<script>
import http from '../utils/http';
export default {
  name: 'thread-form',
  data: function() {
    return {
      valid: false,
      title: '',
      description: '',
      rules: [
        v => !!v || '必須項目です。'
      ]
    }
  },
  methods: {
    submit: async function() {
      const params = {
        title: this.title,
        description: this.description
      };
      const { status, data } = await http.post('/api/threads', params);
      if (status === 200 && data) {
        this.$refs.form.reset();
        this.$emit('success');
        this.$router.push(`/thread/${data}`);
      } else {
        this.$emit('failure');
      }
    },
    clear: function() {
      this.$refs.form.reset();
    }
  }
}
</script>
