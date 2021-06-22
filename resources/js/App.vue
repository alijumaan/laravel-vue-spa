<template>
    <div>
        <Header />
        <div class="container mb-5" >
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
export default {
    components: {Footer, Links, Header},
    computed: {
        show() {
            return this.$store.state.show_content;
        },
        app_title() {
            return this.$store.state.app_title;
        }
    },
    mounted() {
        if (this.show) {
            this.$store.dispatch('currentUser/isAdmin');
            this.$store.dispatch('currentUser/isSupervisor');
            this.$store.dispatch('currentUser/user');
            this.$store.dispatch('page/getPagesUrl');
            this.$store.dispatch('extinguisher/getExtinguishers')
            this.$store.dispatch('period/getPeriods')
            this.$store.dispatch('contact/getContacts')
            this.$store.dispatch('link/getLinks')
            this.$store.dispatch('building/getAllBuildings', { page: null });
        }
    },
}
</script>

<style>

</style>
