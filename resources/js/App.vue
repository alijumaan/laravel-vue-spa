<template>
    <div>
        <Header />
        <div class="container mb-5">
            <Links />
            <router-view></router-view>
        </div>
        <Footer />
    </div>
</template>

<script>
import Header from "./components/Header.vue";
import Links from "./components/Links.vue";
import Footer from "./components/Footer.vue";
import {computed, onMounted} from "vue";
import {useStore} from "vuex";

export default {
    components: {Footer,
        Links,
        Header
    },
    setup() {
        const store = useStore();
        const show = computed(() => store.state.show_content)
        const app_title = computed(() => store.state.app_title)

        if (show.value) {
            store.dispatch('currentUser/isAdmin')
            store.dispatch('currentUser/isSupervisor')
            store.dispatch('currentUser/user')
            store.dispatch('page/getPagesUrl')
            store.dispatch('extinguisher/getExtinguishers')
            store.dispatch('period/getPeriods')
            store.dispatch('link/getLinks')
        }

        return {show, app_title}
    },
}
</script>
