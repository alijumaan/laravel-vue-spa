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
    components: {Footer, Links, Header}
}
</script>

<style>

</style>
