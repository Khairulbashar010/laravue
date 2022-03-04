import axios from "axios";
// getters
const state = {
    user: null,
    token: null
}
// mutations
const mutations = {
    SET_TOKEN(state, token){
        state.token = token;
    },
    SET_USER(state, user) {
        state.user = user;
    }
}
// actions
const actions = {
    async loginUser({dispatch, commit}, user) {
        const response = await axios.post('login',user).catch(e => {
            console.log(e);
        });
        if(response.data.success){
            dispatch('attempt', response.data.access_token)
        } else {
            commit('SET_TOKEN', null);
            commit('SET_USER', null);
        }
    },

    async attempt({commit}, token) {
         const response = await axios.get('me',{
            headers: {
                "Authorization":`Bearer ${token}`
            }
        }).catch(e => {
            console.log(e);
        })
        if(response.data.success) {
            localStorage.setItem(
                'token',
                response.data.token
            )
            commit('SET_TOKEN', response.data.token);
            commit('SET_USER', response.data.user);
        } else {
            commit('SET_TOKEN', null);
            commit('SET_USER', null);
        }

    }
}
// getters
const getters = null


export default {
    namespaced:true,
    state,
    getters,
    actions,
    mutations,
}