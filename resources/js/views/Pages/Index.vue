<template>
    <div class="card shadow bg-white">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>موضوع الصفحة</th>
                    <th>عنوان الصفحة URI</th>
                    <th>تحرير</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="page in pages">
                    <td>{{ page.title }}</td>
                    <td>
                        <router-link :to="{ name: 'pageShow', params: { id: page.slug } }">
                        {{ page.slug }}
                        </router-link>
                    </td>
                    <td>
                        <router-link
                            v-if="isAdmin"
                            :to="{ name: 'pageEdit', params: { id: page.slug } }">
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
