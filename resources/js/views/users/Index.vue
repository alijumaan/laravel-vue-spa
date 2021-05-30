<template>
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="d-flex mb-3">
                <router-link class="ml-auto btn btn-primary btn-sm" :to="{name: 'usersCreate'}">
                    إضافة مستخدم جديد
                </router-link>
            </div>
            <div class="card shadow">
                <div class="p-3 d-flex">
                    <h4 class="text-success">المستخدمين الفعالين</h4>
                    <h4 class="ml-auto">العدد الكلي <span class="badge badge-success">{{ usersCount }}</span></h4>
                </div>
                <div class="table table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="">
                        <tr class="bg-dark text-white">
                            <th>ID</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الصلاحية</th>
                            <th>تاريخ التسجيل</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role_id }}</td>
                            <td>{{ user.created_at }}</td>
                            <td class="d-flex">
                                <router-link class="mr-auto" :to="{ name: 'usersEdit', params: { id: user.id } }">
                                    <i class="fa fa-edit"></i>
                                </router-link>
                                <a @click="delete_user(user.id)" class="mr-auto trash" href="javascript:void(0);">
                                    <i class="fas fa-user-slash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        <tr v-show="!users.length > 0">
                            <td colspan="6" class="text-center">لايوجد نتائج .</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="p-3 d-flex">
                    <h4 class="text-danger">المستخدمين غير المفعلين</h4>
                    <h4 class="ml-auto">العدد الكلي <span class="badge badge-success">{{ unActiveUsersCount }}</span>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="">
                        <tr class="bg-dark text-white">
                            <th>ID</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الصلاحية</th>
                            <th>تاريخ التسجيل</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in unActiveUsers">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role_id }}</td>
                            <td>{{ user.created_at }}</td>
                            <td class="d-flex">
                                <a @click="restore(user.id)" class="mr-auto" href="javascript:void(0);">
                                    <i class="fas fa-trash-restore"></i>
                                </a>
                                <a @click="delete_user_force(user.id)" class="mr-auto trash" href="javascript:void(0);">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        <tr v-show="!unActiveUsers.length > 0">
                            <td colspan="6" class="text-center">لايوجد مستخدمين غير مفعلين .</td>
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
            users: [],
            usersCount: 0,
            unActiveUsersCount: 0,
            unActiveUsers: []
        }
    },
    created() {
        this.loadUsers();
    },
    methods: {
        loadUsers() {
            axios.get("/api/v1/users").then(response => {
                this.users = response.data.users
                this.unActiveUsers = response.data.unActiveUsers
                this.usersCount = response.data.usersCount
                this.unActiveUsersCount = response.data.unActiveUsersCount
            })
        },
        delete_user(userId) {
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
                    axios.delete("/api/v1/users/" + userId).then(response => {
                        this.loadUsers()
                    })
                    toast.fire({
                        icon: 'success',
                        title: 'تم حذف المستخدم وبإمكانك استراجاعه'
                    })
                }
            })
        },
        delete_user_force(userId) {
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
                    // axios.delete(`/api/users/${userId}/forceDelete`).then(response => {
                    axios.delete('/api/v1/users/' + userId + '/forceDelete').then(response => {
                        this.loadUsers()
                    })
                    toast.fire({
                        icon: 'success',
                        title: 'تم حذف المستخدم نهائي'
                    })
                }
            })
        },
        restore(userId) {
            axios.post(`/api/v1/users/${userId}/restore`).then(response => {
                this.loadUsers()
                toast.fire({
                    icon: 'success',
                    title: 'تم استعادة المستخدم نجاح'
                })
            })
        }
    }
}
</script>

<style scoped></style>
