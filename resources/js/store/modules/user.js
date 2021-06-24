const state = {
    users: []
}

const getters = {}

const mutations = {
    setUsers(state) {
        axios.get('/api/v1/users').then(response => {
            state.users = response.data.users
        })
    }
}

const actions = {
    getUsers(context) {
        context.commit('setUsers')
    }
}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
