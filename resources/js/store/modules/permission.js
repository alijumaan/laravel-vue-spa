const state = {
    permissions: [],
    roles: []
}

const getters = {}

const mutations = {
    setPermissions(state) {
        axios.get('/api/v1/permissions').then(response => {
            state.permissions = response.data.permissions
            state.roles = response.data.roles
        });
    }
}

const actions = {
    getPermissions(context) {
        context.commit('setPermissions')
    }
}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
