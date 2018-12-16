<template lang="pug">
  v-form(ref="form" v-model="valid")
    v-text-field(
      v-model="email"
      :rules="emailRules"
      label="メールアドレス"
      required
    )
    v-text-field(
      v-model="password"
      :append-icon="showPassword ? 'visibility_off' : 'visibility'"
      :rules="passwordRules"
      :type="showPassword ? 'text' : 'password'"
      label="パスワード"
      hint="8文字以上"
      counter
      @click:append="showPassword = !showPassword"
    )
    v-btn(:disabled="!valid" @click="submit") ログイン
    v-btn(@click="clear") クリア
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
  data: function() {
    return {
      valid: false,
      email: '',
      password: '',
      showPassword: false,
      emailRules: [
        v => !!v || '必須項目です。',
        v => /.+@.+/.test(v) || '不正なメールアドレスです。'
      ],
      passwordRules: [
        v => !!v || '必須項目です。',
        v => (!!v && v.length >= 8) || 'パスワードは8文字以上にしてください。'
      ]
    }
  },
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    })
  },
  methods: {
    ...mapActions('auth', [
      'logIn'
    ]),
    transitionToHome: function() {
      if (this.isLoggedIn) {
        this.$router.push('/home');
      }
    },
    submit: async function() {
      if (this.$refs.form.validate()) {
        await this.logIn({
          email: this.email,
          password: this.password
        });
        this.transitionToHome();
      }
    },
    clear: function() {
      this.$refs.form.reset();
    }
  }
}
</script>
