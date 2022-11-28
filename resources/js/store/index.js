import { createStore } from "vuex"
import auth from './Auth/index';

const state =  {
  userId: null
}

const getters = {
};

const mutations = {
  setUserId(state, payload) {
    state.userId = payload;
  }
};

const actions = {
  fetchUserId(store) {
  }
};

const store = createStore({
  state,
  mutations,
  actions,
  modules: {
    auth
  }
})

export default store;