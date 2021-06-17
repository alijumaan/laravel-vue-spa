const state = {
    contacts: {}
}

const getters = {}

const actions = {
    getContacts(context) {
        context.commit('setContacts')
    }

}

const mutations = {
    setContacts(state) {
        axios.get("/api/v1/contacts").then(response => {
            state.contacts = response.data.contacts
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
