<template>
    <div class="row">
        <div class="col-md-12">
            <div v-show="isAdmin" class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0">روابط الموقع</h4>
                    <router-link :to="{ name: 'linksCreate'}"
                                 class="ml-auto btn btn-primary btn-sm">
                        <i class="fa fa-plus fa-fw"></i>
                        انشاء رابط
                    </router-link>
                </div>

                <div class="table-responsive">
                    <table class="table table-content table-hover">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>Url</th>
                            <th>الايقونة</th>
                            <th>امكانية الوصول</th>
                            <th>الإجراءات</th>
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
                                    <router-link :to="{ name: 'linksEdit', params: { id: link.id } }" title="تعديل"
                                                 class="btn-primary btn btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </router-link>
                                    <a href="javascript:void(0);" @click="delete_link(link.id)"
                                       title="حذف" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
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
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'تأكيد الحذف'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/v1/links/' + link_id).then(() => {
                        this.$router.push('/links');
                        this.loadLinks();
                    })
                    toast.fire({
                        icon: 'success',
                        title: 'تم حذف الرابط نجاح'
                    })
                }
            })
        },
    }
}
</script>

<style scoped>

</style>
