import axios from "axios";
import { reject } from "lodash";
const headers = {

};
// getters
const state = {}

// getters
const getters = {}

// actions
const actions = {
    loginUser({}, user) {
        axios.post('login',{
                email:user.email,
                password:user.password,
        },headers).then(response => {
            if(response.data.access_token){
                localStorage.setItem(
                    'user_token',
                    response.data.access_token
                )
            } else {
                reject(response);
            }
        }).catch(error => {
            reject(error);
        })
    }
}

// mutations
const mutations = {}

export default {
    namespaced:true,
    state,
    getters,
    actions,
    mutations,
}