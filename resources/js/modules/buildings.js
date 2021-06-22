import {computed, reactive, ref, toRefs} from "vue";
import {useStore} from "vuex";

export default function useBuildings() {
    const store = useStore();

    const per_page = computed(() => {return store.state.building.per_page})
    const records = computed(() => {return store.state.building.records})
    const buildings = computed(() => store.state.building.buildings)
    const loading = computed(() => store.state.building.loading)

    const state = reactive({
        page: store.state.building.page,
        search: store.state.building.search,
        now: new Date().toISOString(),
    });

    const handlePageUpdate = ([page]) => {
        state.page = page
        return loadBuildings();
    };

    const loadBuildings = () => {
        return store.dispatch('building/getAllBuildings', {page: state.page})
    }

    return {
        ...toRefs(state),
        per_page,
        records,
        buildings,
        loading,
        loadBuildings,
        handlePageUpdate
    }
}










// import {reactive, ref, toRefs} from "vue";
// import {useStore} from "vuex";
//
// export default function useBuildings() {
//     const store = useStore();
//
//     const state = reactive({
//         search: "",
//         buildings: {},
//         records: 0,
//         per_page: 0,
//         page: 1,
//         loading: true,
//         now: new Date().toISOString(),
//     });
//
//     const handlePageUpdate = ([page, per_page]) => {
//         state.page = page;
//         state.per_page = per_page;
//         loadBuildings();
//     };
//
//     const loadBuildings = () => {
//         axios.get(`/api/v1/buildings?page=${state.page}`, {
//             params: {
//                 search: state.search.length >= 2 ? state.search : ""
//             }
//         }).then(response => {
//             state.records = response.data.buildings_count
//             state.per_page = response.data.pagination
//             state.buildings = response.data.buildings.map(data => ({
//                 id: data.id,
//                 slug: data.slug,
//                 name: data.name,
//                 number: data.number,
//                 checked_at: data.checked_at,
//                 checked_at_string: data.checked_at_string,
//                 status: data.statusText,
//                 notes: data.notes
//             }));
//
//             state.loading = false;
//         })
//     }
//
//     return {
//         ...toRefs(state),
//         loadBuildings,
//         handlePageUpdate
//     }
// }
