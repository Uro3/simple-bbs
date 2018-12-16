import cookies from 'js-cookie';
import http from '../../utils/http';

const state = {
  isLoggedIn: cookies.get('passport-token') ? true : false
};

const mutations = {
  setLogInState: (state, status) => {
    state.isLoggedIn = status;
  }
};

const actions = {
  logIn: async ({ commit }, params) => {
    try {
      // ユーザ認証 & アクセストークン取得
      const res = await http.post('/oauth/token', {
        'client_id': window.Laravel.clientId,
        'client_secret': window.Laravel.clientSecret,
        'username': params.email,
        'password': params.password,
        'grant_type': 'password',
        'scope': ''
      });
      if (res.status === 200 && res.data && res.data.access_token) {
        // クッキーにトークンを保存
        cookies.set('passport-token', res.data.access_token);
        commit('setLogInState', true);
      }
    } catch (e) {
      console.error(e);
    }
  },
  logOut: ({ commit }, params) => {
    // クッキーからトークンを削除
    cookies.remove('passport-token');
    commit('setLogInState', false);
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions
};
