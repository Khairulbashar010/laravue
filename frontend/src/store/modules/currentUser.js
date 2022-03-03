import axios from "axios"
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
const state = {}
const getters = {}
const actions = {
    async loginUser({}, user) {
        await axios.post('http://localhost:8000/api/login' {
            email:user.email,
            password:user.password,
        }).then(()=> {
            console.log(response.data)
        }).catch(($e) => {
            console.log($e)
        })
    }
}
const mutations = {}

export default {
    namespaced:true,
    state,
    getters,
    actions,
    mutations,
}