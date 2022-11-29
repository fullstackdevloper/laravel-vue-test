import { questions, survey } from '../../Services/surveyService';

const state = {
  error: false,
  questions: [],
}

const mutations = {
  setQuestions(state, payload) {
    state.questions = payload.data;
    state.error = false;
  },
  surveyError(state, message) {
    state.error = message;
  }
};

const getters = {
  questions(state) {
    return state.questions
  },
  surveyError(state) {
    return state.error
  }
}

const actions = {
  fetchQuestions({ commit, state }) {
    questions().then(function (response) {
      console.log(['log', response.data.data])
      commit('setQuestions', response.data);
    }).catch(function (error) {
      if (error.response.status == 401) {
        commit('authError', 'Invalide email or password');
      }
    });
  },
  submitSurvey({ commit, state }, data) {
    survey(data).then(function (response) {
      // commit('setQuestions', response.data);
      console.log(['response', response]);
    }).catch(function (error) {
      if (error.response.status == 401) {
        commit('authError', 'Invalide email or password');
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