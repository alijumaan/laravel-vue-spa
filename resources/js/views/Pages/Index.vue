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
                    <tr v-for="page in pages" :key="page.id">
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
                                @click="deletePage(page.slug)"
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
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    setup() {
        const i18n = useI18n()
        const router = useRouter()
        const store = useStore()
        const isAdmin = computed(() => { return store.state.currentUser.isAdmin })

        const pages = computed(() => { return store.state.page.pages })
        if (store.state.loaded_pages === true) {
            store.dispatch('page/getAllPages')
            store.state.loaded_pages = false
        }

        function deletePage(pageId) {
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
                    axios.delete('/api/v1/pages/' + pageId).then(response => {
                        toast.fire({
                            icon: 'success',
                            title: i18n.t('messages.deleted_successfully')
                        })
                        store.dispatch('page/getAllPages')
                        router.push({name: 'pages'})
                    }).catch(error => {
                        console.log(error)
                    })
                }
            }).catch(error => {
                console.log(error)
            })
        }

        return {
            isAdmin,
            pages,
            deletePage
        }
    }
}
</script>

<style scoped></style>
