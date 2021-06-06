const state = {
    buildings: {},
}

const getters = {}

const actions = {
    getBuilding(context) {
        context.commit('setBuilding')
    }
}

const mutations = {
    setBuilding(state) {
        axios.get('/api/v1/buildings_list').then(response => {
            state.buildings = response.data.buildings
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
