const state = {
    periods: []
}

const getters = {}

const mutations = {
    setPeriods(state) {
        axios.get("/api/v1/periods").then(response => {
            state.periods = response.data.periods
        });
    }
}

const actions = {
    getPeriods(context) {
        context.commit('setPeriods')
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
