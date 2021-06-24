import {createStore} from "vuex";
import currentUser from "./modules/currentUser";
import page from "./modules/page";
import building from "./modules/building";
import period from "./modules/period";
import contact from "./modules/contact";
import extinguisher from "./modules/extinguisher";
import user from "./modules/user";
import link from "./modules/link";

export const store = createStore({
    state: {
        app_title: 'الإطفاء والسلامة',
        show_content: !!localStorage.getItem("authToken"),
        loaded_buildings: true,
        loaded_periods: true,
        loaded_extinguishers: true,
        loaded_pages: true,
        loaded_contacts: true,
        loaded_users: true,
        loaded_links: true,
    },
    getters: {},

    actions: {},

    mutations: {},

    modules: {
        currentUser,
        page,
        building,
        period,
        extinguisher,
        contact,
        user,
        link
    }
});
