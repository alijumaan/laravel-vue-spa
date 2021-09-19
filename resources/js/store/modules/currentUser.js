const state = {
    user: "",
    isAdmin: false,
    isSupervisor: false
}

const getters = {}

const actions = {
    user(context) {
        context.commit('user')
    },
    isAdmin(context) {
        context.commit('isAdmin')
    },
    isSupervisor(context) {
        context.commit('isSupervisor')
    }
}

const mutations = {
    user(state) {
        axios.get('/api/v1/user/details').then(response => {
            state.user = response.data.user
        })
    },
    isAdmin(state) {
        axios.get('/api/v1/admin').then(response => state.isAdmin = response.data)
    },
    isSupervisor(state) {
        axios.get('/api/v1/supervisor').then(response => state.isSupervisor = response.data)
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
