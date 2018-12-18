<template lang="pug">
  div#signup
    v-form(ref="form" v-model="valid")
      v-text-field(
        v-model="name"
        :rules="nameRules"
        :counter="20"
        label="名前"
        required
      )
      v-text-field(
        v-model="email"
        :rules="emailRules"
        label="メールアドレス"
        required
      )
      v-text-field(
        v-model="password"
        :append-icon="showPassword ? 'visibility_off' : 'visibility'"
        :rules="[passwordRules.required, passwordRules.length]"
        :type="showPassword ? 'text' : 'password'"
        label="パスワード"
        hint="8文字以上"
        counter
        @click:append="showPassword = !showPassword"
      )
      v-text-field(
        v-model="passwordConfirmation"
        :append-icon="showPasswordConfirmation ? 'visibility_off' : 'visibility'"
        :rules="[passwordRules.required]"
        :type="showPasswordConfirmation ? 'text' : 'password'"
        label="パスワードの確認"
        hint="パスワードをもう一度入力してください"
        counter
        @click:append="showPasswordConfirmation = !showPasswordConfirmation"
      )
      v-btn(:disabled="!valid" @click="submit") サインアップ
      v-btn(@click="clear") クリア
    div.mt-4
      router-link(to="/login") ログインはこちら
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
  data: function() {
    return {
      valid: false,
      name: '',
      email: '',
      password: '',
      passwordConfirmation: '',
      showPassword: false,
      showPasswordConfirmation: false,
      nameRules: [
        v => !!v || '必須項目です',
        v => (!!v && v.length <= 20) || '名前は最大20文字です。'
      ],
      emailRules: [
        v => !!v || '必須項目です。',
        v => /.+@.+/.test(v) || '不正なメールアドレスです。'
      ],
      passwordRules: {
        required: v => !!v || '必須項目です。',
        length: v => (!!v && v.length >= 8) || 'パスワードは8文字以上にしてください。'
      }
    }
  },
  computed: {
    ...mapState('auth', {
      isLoggedIn: state => state.isLoggedIn,
    })
  },
  methods: {
    ...mapActions('auth', [
      'signUp'
    ]),
    ...mapActions('user', [
      'getUserInfo'
    ]),
    transitionToHome: async function() {
      if (this.isLoggedIn) {
        await this.getUserInfo();
        this.$router.push('/home');
      }
    },
    submit: async function() {
      if (this.$refs.form.validate()) {
        await this.signUp({
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.passwordConfirmation
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
