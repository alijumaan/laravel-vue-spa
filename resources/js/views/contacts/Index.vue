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
                        <tr v-for="message in messages">
                            <td>{{ message.name }}</td>
                            <td>{{ message.title }}</td>
                            <td>
                                <span
                                    :class="message.is_read === 'جديد' ? 'badge badge-danger' : 'badge badge-success'">
                                    {{ message.is_read }}
                                </span>
                            </td>
                            <td>{{ message.created_at }}</td>
                            <td>
                                <div class="btn-group btn-group-toggle">
                                    <router-link :to="{ name: 'contactShow', params: { id: message.id } }" title="Show"
                                                 class="btn-primary btn btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </router-link>
                                    <a href="javascript:void(0);" @click="delete_message(message.id)"
                                       title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr v-show="!messages.length">
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
            messages: {},
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.loadMessages();
    },
    methods: {
        loadMessages() {
            axios.get("/api/v1/contacts").then(response => {
                this.messages = response.data.data
            })
        },
        delete_message(msg) {
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
                        this.loadMessages();
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
