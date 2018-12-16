import http from '../../utils/http';

const state = {
  name: ''
};

const mutations = {
  setName: (state, name) => {
    state.name = name;
  }
};

const actions = {
  getUserInfo: async ({ commit }, params) => {
    try {
      // ログイン中のユーザ情報取得
      const res = await http.get('/api/users');
      if (res.status === 200 && res.data) {
        commit('setName', res.data.name);
      }
    } catch (e) {
      console.error(e);
    }
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions
};
