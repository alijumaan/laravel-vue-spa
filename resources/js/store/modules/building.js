const state = {
    building: [],
    search: "",
    page: 1,
    buildings: [],
    buildingsHasNotes: [],
    records: 0,
    per_page: 0,
    loading: true
}

const getters = {}

const mutations = {
    setBuildings(state, page = state.page) {
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
    setBuildingsHasBuildings(state, page = state.page) {
        axios.get(`/api/v1/buildings/has-notes?page=${page}`).then(response => {
            state.records = response.data.buildings_has_notes_count
            state.per_page = response.data.pagination
            state.buildingsHasNotes = response.data.buildingsHasNotes.map(data => ({
                id: data.id,
                name: data.name,
                notes: data.notes
            }))
            state.loading = false;
        })
    },
    setBuilding(state, param) {
        axios.get(`/api/v1/buildings/${param}`).then(response => {
            state.building = response.data.building
        }).catch(error => {
            console.log(error)
        })
    }
}

const actions = {
    getBuildings(context, data) {
        context.commit('setBuildings', data.page)
    },
    getBuildingsHasNotes(context, data) {
        context.commit('setBuildingsHasBuildings', data.page)
    },
    getBuilding(context, data) {
        context.commit('setBuilding', data.param)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
