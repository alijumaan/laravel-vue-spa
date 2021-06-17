const state = {
    buildings: {},
    building: {},
    records: 0,
    per_page: 0,
    page: 1,
    loading: true
}

const getters = {}

const actions = {
    getAllBuildings(context, data) {
        context.commit('setAllBuildings', data.page)
    },
    getBuilding(context, data) {
        context.commit('setBuilding', data.param)
    }
}

const mutations = {
    setAllBuildings(state, page = state.page) {
        axios.get(`/api/v1/buildings?page=${page}`).then(response => {
            state.records = response.data.buildings_count
            state.per_page = response.data.pagination
            state.buildings = response.data.buildings.map(data => ({
                slug: data.slug,
                name: data.name,
                number: data.number,
                checked_at: data.checked_at,
                checked_at_string: data.checked_at_string,
                status: data.statusText,
                notes: data.notes
            }))
            state.loading = false;
        })
    },
    setBuilding(state, param) {
        axios.get(`/api/v1/buildings/${param}`).then(response => {
            state.building = response.data.building
        }).catch(error => {
            console.log('Error show the building')
        })
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
