import {createStore} from "vuex";
import currentUser from "./modules/currentUser";
import page from "./modules/page";
import building from "./modules/building";
import period from "./modules/period";

export const store = createStore({
    state: {
        app_title: 'الإطفاء والسلامة',
        show_content: !!localStorage.getItem("authToken"),
        loaded_buildings: true,
        loaded_building: true,
        loaded_periods: true,
    },
    getters: {},// computed properties

    actions: {}, // methods

    mutations: {}, // for changing the state

    modules: {
        currentUser,
        page,
        building,
        period
    }
});
