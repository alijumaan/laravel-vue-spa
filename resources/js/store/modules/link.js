const state = {
    links: {}
}

const getters = {}

const actions = {
    getLinks(context) {
        context.commit('setLinks')
    }
}

const mutations = {
    setLinks(state) {
        axios.get("/api/v1/links").then(response => {
            state.links = response.data.links
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
