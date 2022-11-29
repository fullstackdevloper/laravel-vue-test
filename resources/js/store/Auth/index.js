import { login, register} from '../../Services/authService';

const state = {
  authenticated: localStorage.getItem('token'),
  error: false,
}

const mutations = {
  removeAuth(state) {
    state.authenticated = null;
    localStorage.removeItem('token');
  },
  setAuth(state, payload) {
    state.authenticated = payload.access_token;
    state.error = false;
    localStorage.setItem('token', payload.access_token);
    localStorage.setItem('expires_at', payload.expires_at);
  },
  authError(state, message) {
    state.error = message;
  }
};

const getters = {
  isAuthenticated(state) {
    return state.authenticated
  },
  authError(state) {
    return state.error
  }
}

const actions = {
  userLogin({ commit, state }, data) {
    login(data).then(function (response) {
      commit('setAuth', response.data);
    }).catch(function (error) {
      if(error.response.status == 401) {
        commit('authError', 'Invalide email or password');
      }
    });
  },
  userRegister({ commit, state }, data) {
    register(data).then(function (response) {
      if(response.data.status == false) {
        commit('authError', response.data.message);
      } else {
        commit('setAuth', response.data);
      }
    }).catch(function (error) {
      commit('authError', error.response.data.message);
    });
  }
};

export default {
  state,
  getters,
  mutations,
  actions,
  namespaced: true
}