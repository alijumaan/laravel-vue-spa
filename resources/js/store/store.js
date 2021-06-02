import {createStore} from "vuex";
import currentUser from "./modules/currentUser";
import page from "./modules/page";
import building from "./modules/building";

export const store = createStore({
    state: { // data
        app_title: 'الوقاية من الحريق',
        show_content: !!localStorage.getItem("authToken"),

    },
    getters: { // computed properties

    },
    actions: { // methods

    },
    mutations: { // used for changing the state

    },
    modules: {
        currentUser,
        page,
        building
    }
})
