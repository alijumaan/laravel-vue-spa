const state = {
    users: [],
    roles: [],
    unActiveUsers: [],
    usersCount: 0,
    unActiveUsersCount: 0,
    currentUser: []
}

const getters = {}

const mutations = {
    setUsers(state) {
        axios.get('/api/v1/users').then(response => {
            state.users = response.data.users
            state.unActiveUsers = response.data.unActiveUsers
            state.usersCount = response.data.usersCount
            state.unActiveUsersCount = response.data.unActiveUsersCount
        })
    },
    setCurrentUser(state, userId) {
        axios.get(`/api/v1/users/${userId}`).then(response => {
            state.currentUser = response.data.user
        })
    },
    setRoles(state) {
        axios.get("/api/v1/roles").then(response => {
            state.roles = response.data.roles
        })
    },
}

const actions = {
    getUsers(context) {
        context.commit('setUsers')
    },
    getCurrentUser(context, data) {
        context.commit('setCurrentUser', data.userId)
    },
    getRoles(context) {
        context.commit('setRoles')
    }
}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
