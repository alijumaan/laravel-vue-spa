const state = {
    pages: [],
    page: ''
}

const getters = {}

const mutations = {
    setAllPages(state) {
        axios.get("/api/v1/pages").then(response => {
            state.pages = response.data.pages
        });
    },

    setPage(state, pageId) {
        axios.get('/api/v1/pages/' + pageId).then(response => {
            state.page = response.data.page
        })
    },

    delete_page(state, pageId) {
        axios.delete('/api/v1/pages/' + pageId).then(() => {
        })
    }
}

const actions = {
    getAllPages(context) {
        context.commit('setAllPages')
    },
    getPage(context, data) {
        context.commit('setPage', data.pageId)
    },
    delete_page(context, data) {
        context.commit('delete_page', data.pageId)
    }

}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
