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
    data() {
        return {
            show: this.$store.state.show_content,
            app_title: this.$store.state.app_title,
        }
    },
    created() {
        if (this.show) {
            this.$store.dispatch('currentUser/isAdmin');
            this.$store.dispatch('currentUser/isSupervisor');
            this.$store.dispatch('currentUser/user');
            this.$store.dispatch('page/getPagesUrl');
            this.$store.dispatch('extinguisher/getExtinguishers')
            this.$store.dispatch('period/getPeriods')
            this.$store.dispatch('contact/getContacts')
            this.$store.dispatch('building/getAllBuildings', { page: this.page });
        }
    },
}
</script>

<style>

</style>
