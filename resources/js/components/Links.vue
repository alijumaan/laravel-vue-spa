<template>
    <div>
        <section class="text-center mb-5">
            <div class="container">
                <h1 class="jumbotron-heading"></h1>
                <p class="lead text-muted"></p>
                <span v-for="item in navbar_items">
                    <router-link class="mt-2 mr-1 btn btn-secondary" exact :to="item.to">
                        <i :class="`fa fa-${item.icon}`"></i>
                        {{ $t(`generals.${item.name}`)}}
                    </router-link>
                </span>
                <router-link v-show="!show" class="mt-2 mr-1 btn btn-secondary" exact to="/login">
                    <i class="fas fa-sign-in-alt"></i>
                    {{ $t('buttons.login')}}
                </router-link>
                <router-link v-show="isAdmin" class="mt-2 mr-1 btn btn-secondary" exact :to="{ name: 'links' }">
                    {{ $t('generals.links') }}
                </router-link>
                <router-link v-show="isAdmin" class="mt-2 mr-1 btn btn-secondary" exact :to="{ name: 'permissions.create' }">
                    {{ $t('buttons.new_permission')}}
                </router-link>
            </div>
        </section>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    setup() {
        const store = useStore()
        const show = store.state.show_content;
        const isAdmin = computed(() => { return store.state.currentUser.isAdmin })

        const navbar_items = computed(() => { return store.state.link.navbar_items })
        if (show) {
            if (store.state.loaded_urls === true) {
                store.dispatch('link/getUrl')
                store.state.loaded_urls = false
            }
        }

        return {
            navbar_items,
            show,
            isAdmin
        }
    }
}
</script>

<style scoped>
.btn-secondary {
    color: #fff;
    background-color: #1e2b35;
    border-color: #4684bb;
}
</style>
