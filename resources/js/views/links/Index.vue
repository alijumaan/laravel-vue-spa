<template>
    <div class="row">
        <div class="col-md-12">
            <div v-show="isAdmin" class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0">{{ $t('titles.website_links') }}</h4>
                    <router-link :to="{ name: 'links.create'}"
                                 class="ml-auto btn btn-primary btn-sm">
                        <i class="fa fa-plus fa-fw"></i>
                        {{ $t('buttons.create_new_link') }}
                    </router-link>
                </div>

                <div class="table-responsive">
                    <table class="table table-content table-hover">
                        <thead>
                        <tr>
                            <th>{{ $t('fields.name') }}</th>
                            <th>{{ $t('fields.url') }}</th>
                            <th>{{ $t('fields.icon') }}</th>
                            <th>{{ $t('fields.status') }}</th>
                            <th>{{ $t('fields.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="link in links">
                            <td>{{ link.name }}</td>
                            <td>{{ link.to }}</td>
                            <td>{{ link.icon}}</td>
                            <td>{{ link.access }}</td>
                            <td>
                                <div class="btn-group btn-group-toggle">
                                    <router-link :to="{ name: 'links.edit', params: { id: link.id } }" :title="$t('actions.edit')"
                                                 class="btn-primary btn btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </router-link>
                                    <a href="javascript:void(0);" @click="delete_link(link.id)"
                                       :title="$t('actions.delete')" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr v-show="!links.length">
                            <td colspan="5" class="text-center">لاتوجد روابط.</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            links: {},
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.loadLinks();
    },
    methods: {
        loadLinks() {
            axios.get("/api/v1/links").then( response => {
                this.links = response.data.links
            })
        },
        delete_link(link_id) {
            swal.fire({
                title: this.$i18n.t('messages.are_you_sour?'),
                text: this.$i18n.t('messages.You_wont_be_able_to_undo_this'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: this.$i18n.t('messages.delete_confirmation')
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/v1/links/' + link_id).then(() => {
                        this.$router.push('/links');
                        this.loadLinks();
                    })
                    toast.fire({
                        icon: 'success',
                        title: this.$i18n.t('messages.deleted_successfully')
                    })
                }
            })
        },
    }
}
</script>

<style scoped>

</style>
