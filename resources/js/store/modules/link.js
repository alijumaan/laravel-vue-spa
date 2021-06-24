const state = {
    links: []
}

const getters = {}

const mutations = {
    setLinks(state) {
        axios.get("/api/v1/links").then(response => {
            state.links = response.data.links
        });
    }
}

const actions = {
    getLinks(context) {
        context.commit('setLinks')
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
