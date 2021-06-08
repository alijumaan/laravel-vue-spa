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
export default {
    data() {
        return {
            page: {}
        }
    },
    created() {
        this.loadPage()
    },
    methods: {
        loadPage() {
            axios.get(`/api/v1/pages/${this.$route.params.id}`).then(response => {
                this.page = response.data.page
            })
        }
    }
}
</script>

<style scoped></style>
