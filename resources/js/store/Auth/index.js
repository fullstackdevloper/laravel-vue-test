const state = {
  authenticated: localStorage.getItem('token'),
  error: false
}

const mutations = {
  removeAuth(state) {
    state.authenticated = null;
    localStorage.removeItem('token');
  },
  setAuth(state, payload) {
    state.authenticated = payload.token;
    localStorage.setItem('token', payload.token);
    localStorage.setItem('expires_at', payload.expires_at);
  }
};

const getters = {
  isAuthenticated(state) {
    return state.authenticated
  }
}

export default {
  state,
  getters,
  mutations,
  namespaced: true
}