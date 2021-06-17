const state = {
    extinguishers: {}
}

const getters = {}

const actions = {
    getExtinguishers(context) {
        context.commit('setExtinguishers')
    }
}

const mutations = {
    setExtinguishers(state) {
        axios.get("/api/v1/extinguishers").then(response => {
            state.extinguishers = response.data.extinguishers
        });
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
