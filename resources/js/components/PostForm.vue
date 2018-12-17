<template lang="pug">
  div.post-form
    v-form(ref="form" v-model="valid")
      v-textarea(
        v-model="message"
        :rules="rules"
        label="投稿テキスト"
        auto-grow
        required
      )
      v-btn(:disabled="!valid" @click="submit") 投稿
      v-btn(@click="clear") クリア
</template>

<script>
import http from '../utils/http';
export default {
  name: 'post-form',
  props: {
    threadId: {
      type: [Number, String],
      required: true
    }
  },
  data: function() {
    return {
      valid: false,
      message: '',
      rules: [
        v => !!v || '必須項目です。'
      ]
    }
  },
  methods: {
    submit: async function() {
      const params = {
        thread_id: this.threadId,
        message: this.message
      };
      const { status, data } = await http.post('/api/posts', params);
      if (status === 200 && data) {
        this.$refs.form.reset();
        this.$emit('success');
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
