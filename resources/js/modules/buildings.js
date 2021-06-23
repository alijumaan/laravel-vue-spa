import {reactive, toRefs} from "vue";

export default function useBuildings() {
    const state = reactive({
        page: 1,
        search: "",
        buildings: {},
        records: 0,
        per_page: 0,
        loading: true
    });

    const handlePageUpdate = ([page, per_page]) => {
        state.page = page;
        state.per_page = per_page;
        loadBuildings();
    };

    const loadBuildings = (page = state.page) => {
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
    }

    return {
        ...toRefs(state),
        loadBuildings,
        handlePageUpdate,
    }
}
