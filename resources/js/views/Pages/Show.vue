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
import {ref} from "vue";
import {useRoute} from "vue-router";

export default {
    setup() {
        const page = ref([])
        const route = useRoute()

        function loadPage() {
            axios.get(`/api/v1/pages/${route.params.id}`).then(response => {
                page.value = response.data.page
            })
        }

        loadPage();

        return {page}
    }
}
</script>

<style scoped></style>
