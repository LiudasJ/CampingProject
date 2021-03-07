import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'

export default new Vuex.Store({
    state: {
      user: null,
      createdCamp: null
    },
  
    mutations: {
      setUserData (state, userData) {
        state.user = userData
        localStorage.setItem('user', JSON.stringify(userData))
        axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
      },
  
      clearUserData () {
        localStorage.removeItem('user')
        location.reload()
      },
      setRecentlyCreatedCamping (state, campData) {
        state.createdCamp = campData
      }
    },
    actions: {
      login ({ commit }, credentials) {
        return axios
          .post('/login', credentials)
          .then(({ data }) => {
            commit('setUserData', data)
          })
      },
      register({commit}, credentials) {
        console.log(credentials);
        return axios
          .post('/register', credentials)
          .then(({data}) => {
            commit('setUserData', data)
          });
      },
      addCamping({commit}, camping) {
        console.log(camping);
        return axios
        .post('/add', camping)
        .then(({data}) => {
          commit('setRecentlyCreatedCamping', data)
        });
      },
      logout ({ commit }) {
        commit('clearUserData')
      }
    },
    getters : {
      isLogged: state => !!state.user
    }
  })