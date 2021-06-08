<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div v-if="isAdmin" class="d-flex mb-3">
                <router-link :to="{ name: 'pages.create'}"
                             class="ml-auto btn btn-primary btn-sm">
                    <i class="fa fa-plus fa-fw"></i>
                    {{ $t('buttons.create_new_page') }}
                </router-link>
            </div>

            <div class="card shadow">
                <table class="table table-hover bg-white">
                    <thead>
                    <tr>
                        <th>{{ $t('fields.topic_page') }}</th>
                        <th>{{ $t('fields.url_address') }}</th>
                        <th>{{ $t('actions.edit') }}</th>
                        <th>{{ $t('actions.delete') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="page in pages">
                        <td>{{ page.title }}</td>
                        <td>
                            <router-link :to="{ name: 'pages.show', params: { id: page.slug } }">
                                {{ page.slug }}
                            </router-link>
                        </td>
                        <td>
                            <router-link
                                v-if="isAdmin"
                                :to="{ name: 'pages.edit', params: { id: page.slug } }">
                                <i class="fa fa-edit mr-1"></i>
                            </router-link>
                        </td>

                        <td>
                            <button
                                v-if="isAdmin"
                                @click="delete_page(page.slug)"
                                class="btn btn-link">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        },
        pages() {
            return this.$store.state.page.pages;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.$store.dispatch('page/getPagesUrl');
    },
    methods: {
        delete_page(page_slug) {
            this.$store.dispatch('page/delete_page', page_slug)
        }
    },

}
</script>

<style scoped></style>
