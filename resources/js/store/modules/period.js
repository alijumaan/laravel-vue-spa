const state = {
    periods: {}
}

const getters = {}

const actions = {
    getPeriods(context) {
        context.commit('setPeriods')
    }

}

const mutations = {
    setPeriods(state) {
        axios.get("/api/v1/periods").then(response => {
            state.periods = response.data.periods
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
