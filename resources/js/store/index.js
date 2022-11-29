import { createStore } from "vuex"
import auth from './Auth/index';
import survey from './Survey/index';
import user from './User/index';

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
    auth,
    survey,
    user
  }
})

export default store;