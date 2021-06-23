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
                            <td>{{ link.icon }}</td>
                            <td>{{ link.access }}</td>
                            <td>
                                <div class="btn-group btn-group-toggle">
                                    <router-link :to="{ name: 'links.edit', params: { id: link.id } }"
                                                 :title="$t('actions.edit')"
                                                 class="btn-primary btn btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </router-link>
                                    <a href="javascript:void(0);" @click="deleteLink(link.id)"
                                       :title="$t('actions.delete')" class="btn-danger btn btn-sm"><i
                                        class="fa fa-trash"></i>
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
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";
import {computed, ref} from "vue";
import {useStore} from "vuex";

export default {
    setup() {
        const i18n = useI18n()
        const router = useRouter()
        const store = useStore()

        const isAdmin = computed(() => {
            return store.state.currentUser.isAdmin
        })
        const links = ref([])

        function loadLinks() {
            axios.get("/api/v1/links").then(response => {
                links.value = response.data.links
            });
        }

        loadLinks()

        function deleteLink(link_id) {
            swal.fire({
                title: i18n.t('messages.are_you_sour?'),
                text: i18n.t('messages.You_wont_be_able_to_undo_this'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: i18n.t('messages.delete_confirmation')
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/v1/links/' + link_id).then(() => {
                        router.push('/links');
                        loadLinks();
                    })
                    toast.fire({
                        icon: 'success',
                        title: i18n.t('messages.deleted_successfully')
                    })
                }
            })
        }

        return {
            isAdmin,
            links,
            deleteLink
        }

    }
}
</script>

<style scoped>

</style>
