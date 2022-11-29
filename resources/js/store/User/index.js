import { user } from '../../Services/userService';

const state = {
  error: false,
  user: '',
}

const mutations = {
  setUser(state, payload) {
    state.user = payload.data;
    state.error = false;
  },
  surveyError(state, message) {
    state.error = message;
  }
};

const getters = {
  authUser(state) {
    return state.user
  },
  surveyError(state) {
    return state.error
  }
}

const actions = {
  fetchUserDetail({ commit, state }) {
    user().then(function (response) {
      commit('setUser', response.data);
    }).catch(function (error) {
      if (error.response.status == 401) {
      }
    });
  },
};

export default {
  state,
  getters,
  mutations,
  actions,
  namespaced: true
}