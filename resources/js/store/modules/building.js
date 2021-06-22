const state = {
    buildings: {},
    building: {},
    records: 0,
    per_page: 0,
    page: 1,
    search: "",
    loading: true
}

const getters = {}

const mutations = {

    setAllBuildings(state, page = state.page) {
        axios.get(`/api/v1/buildings?page=${page}`, {
            params: {
                search: state.search.length >= 2 ? state.search : ""
            }
        }).then(response => {
            state.records = response.data.buildings_count
            state.per_page = response.data.pagination
            state.buildings = response.data.buildings.map(data => ({
                id: data.id,
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
    }
}

const actions = {
    getAllBuildings(context, data) {
        context.commit('setAllBuildings', data.page)
    },
    getBuilding(context, data) {
        context.commit('setBuilding', data.param)
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
