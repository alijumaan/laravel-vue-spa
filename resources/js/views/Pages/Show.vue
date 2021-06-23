<template>
    <div>
        <div class="card shadow">
            <div class="card-header d-flex">
                <h5 class="text-primary font-weight-bold"> {{ page.title }} </h5>
                <router-link exact :to="{name: 'pages'}" class="ml-auto btn btn-primary btn-sm">
                    {{ $t('actions.back') }}
                </router-link>
            </div>
            <div class="table-responsive">
                <div class="col-md-12 bg-white content" v-html="page.content"></div>
            </div>
        </div>
    </div>
</template>

<script>
import {computed, ref} from "vue";
import {useRoute} from "vue-router";
import {useStore} from "vuex";

export default {
    setup() {
        const store = useStore()
        const route = useRoute()

        const page = computed(() => { return store.state.page.page })
        if (store.state.loaded_page === true) {
            store.dispatch('page/getPage', { pageId: route.params.id})
            store.state.loaded_page = false
        }

        return {page}
    }
}
</script>
