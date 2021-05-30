import {createStore} from "vuex";
import currentUser from "./modules/currentUser";
import page from "./modules/page";

export const store = createStore({
    state: { // data
        app_title: 'الوقاية والسلامة',

    },
    getters: { // computed properties

    },
    actions: { // methods

    },
    mutations: { // used for changing the state

    },
    modules: {
        currentUser,
        page
    }
})
