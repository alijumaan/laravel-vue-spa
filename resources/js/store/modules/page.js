const state = {
    pages: {}
}

const getters = {}

const actions = {
    getPagesUrl(context) {
        context.commit('setPagesUrl')
    },
    delete_page(context, data) {
        context.commit('delete_page', data.pageId)
    }

}

const mutations = {
    setPagesUrl(state) {
        axios.get("/api/v1/pages").then(response => {
            state.pages = response.data.pages
        });
    },
    delete_page(state, pageId) {
        axios.delete('/api/v1/pages/' + pageId).then(() => {
        })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
