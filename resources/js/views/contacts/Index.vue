<template>
    <div class="row">
        <div class="col-md-12">
            <div v-show="isAdmin" class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0">التواصل او الشكاوي</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-content table-hover">
                        <thead>
                        <tr>
                            <th>المرسل</th>
                            <th>العنوان</th>
                            <th>الحالة</th>
                            <th>التاريخ</th>
                            <th>الإجراءات</th>
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
                                    <router-link :to="{ name: 'contacts.show', params: { id: contact.id } }" title="Show"
                                                 class="btn-primary btn btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </router-link>
                                    <a href="javascript:void(0);" @click="delete_contact_msg(contact.id)"
                                       title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr v-show="!contacts.length">
                            <td colspan="5" class="text-center">لاتوجد رسائل.</td>
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
            contacts: {},
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.loadContacts();
    },
    methods: {
        loadContacts() {
            axios.get("/api/v1/contacts").then(response => {
                this.contacts = response.data.contacts
            }).catch(error => {
                console.log(error)
            })
        },
        delete_contact_msg(msg) {
            swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'تأكيد الحذف'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/v1/contacts/' + msg).then(() => {
                        this.$router.push('/contacts');
                        this.loadContacts();
                    })
                    toast.fire({
                        icon: 'success',
                        title: 'تم حذف الرسالة نجاح'
                    })
                }
            })
        },
    }
}
</script>

<style scoped></style>
