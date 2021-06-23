const state = {
    extinguishers: [],
    extinguishersType: []
}

const getters = {}

const mutations = {
    setExtinguishers(state) {
        axios.get("/api/v1/extinguishers").then(response => {
            state.extinguishers = response.data.extinguishers
        });
    },
    setExtinguisherType() {
        axios.get('/api/v1/extinguishers/type').then(response => {
            state.extinguishersType = response.data.extinguishersType
        })
    }
}

const actions = {
    getExtinguishers(context) {
        context.commit('setExtinguishers')
    },
    getExtinguisherType(context) {
        context.commit('setExtinguisherType')
    }
}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
