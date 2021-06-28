const state = {
    links: [],
    navbar_items: []
}

const getters = {}

const mutations = {
    setLinks(state) {
        axios.get("/api/v1/links").then(response => {
            state.links = response.data.links
        });
    },
    setUrl() {
        axios.get('/api/v1/links/get-url').then(response => {
            state.navbar_items = response.data.url
        })
    }
}

const actions = {
    getLinks(context) {
        context.commit('setLinks')
    },
    getUrl(context) {
        context.commit('setUrl')
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
