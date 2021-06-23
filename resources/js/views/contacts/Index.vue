<template>
    <div class="row">
        <div class="col-md-12">
            <div v-show="isAdmin" class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0">{{ $t('titles.contact_us') }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-content table-hover">
                        <thead>
                        <tr>
                            <th>{{ $t('fields.sender') }}</th>
                            <th>{{ $t('fields.address') }}</th>
                            <th>{{ $t('fields.status') }}</th>
                            <th>{{ $t('fields.created_at') }}</th>
                            <th>{{ $t('fields.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="contact in contacts">
                            <td>{{ contact.name }}</td>
                            <td>{{ contact.title }}</td>
                            <td>
                                <span
                                    :class="contact.is_read === 'جديد' ? 'badge badge-danger' : 'badge badge-success'">
                                    {{ contact.is_read }}
                                </span>
                            </td>
                            <td>{{ contact.created_at }}</td>
                            <td>
                                <div class="btn-group btn-group-toggle">
                                    <router-link :to="{ name: 'contacts.show', params: { id: contact.id } }"
                                                 title="Show"
                                                 class="btn-primary btn btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </router-link>
                                    <a href="javascript:void(0);" @click="deleteMessage(contact.id)"
                                       title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr v-show="!contacts.length">
                            <td colspan="5" class="text-center">{{ $t('messages.no_messages') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const store = useStore()
        const i18n = useI18n()

        const isAdmin = computed(() => {
            return store.state.currentUser.isAdmin
        })

        const contacts = computed(() => { return store.state.contact.contacts })
        if (store.state.loaded_contacts === true) {
            store.dispatch('contact/getContacts')
            store.state.loaded_contacts = false
        }

        const deleteMessage = (msg) => {
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
                    axios.delete('/api/v1/contacts/' + msg).then(() => {
                        // router.push('/contacts');
                        location.replace('/contacts')
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
            contacts,
            deleteMessage
        }
    }
}
</script>

<style scoped></style>
