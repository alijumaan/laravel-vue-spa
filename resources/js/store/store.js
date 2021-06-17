import {createStore} from "vuex";
import currentUser from "./modules/currentUser";
import page from "./modules/page";
import building from "./modules/building";
import extinguisher from "./modules/extinguisher";
import period from "./modules/period";
import contact from "./modules/contact";

export const store = createStore({
    state: {
        app_title: 'الوقاية',
        show_content: !!localStorage.getItem("authToken"),

    },
    getters: { // computed properties

    },
    actions: { // methods

    },
    mutations: { // for changing the state

    },
    modules: {
        currentUser,
        page,
        building,
        extinguisher,
        period,
        contact
    }
})
