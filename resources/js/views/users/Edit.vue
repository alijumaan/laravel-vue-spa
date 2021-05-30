<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex mb-3">
                <router-link exact :to="{name: 'users', params: { id: user.id }}" class="ml-auto btn btn-primary btn-sm">
                    عودة
                </router-link>
            </div>
            <div class="card shadow">
                <div class="p-3 d-flex">
                    <h4>تعديل البيانات</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateUser">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">الإسم</label>
                            <div class="col-md-8">
                                <input v-model="user.name" id="name" type="text" class="form-control" >

                                <div v-if="errors">
                                    <span v-for="error in errors.name" class="text-danger" role="alert">
                                        {{ error }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">البريد الإلكتروني</label>
                            <div class="col-md-8">
                                <input v-model="user.email" id="email" type="email" class="form-control">

                                <div v-if="errors">
                                    <span v-for="error in errors.email" class="text-danger" role="alert">
                                        {{ error }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roleId" class="col-md-4 col-form-label text-md-right">الصلاحية</label>
                            <div class="col-md-8">
                                <select v-model="user.role_id" id="roleId" class="form-control">
                                    <option v-for="role in roles" :value="role.id">{{ role.role }}</option>
                                </select>

                                <div v-if="errors">
                                    <span v-for="error in errors.role_id" class="text-danger" role="alert">
                                        {{ error }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    تعديل
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            user: {},
            roles: [],
            errors: {}
        }
    },
    created() {
        this.loadUser();
        this.loadRoles();
    },
    methods: {
        loadUser() {
            axios.get(`/api/v1/users/${this.$route.params.id}`).then(response => {
                this.user = response.data.user
            })
        },

        loadRoles() {
            axios.get("/api/v1/roles").then(response => {
                this.roles = response.data.roles
            })
        },

        updateUser() {
            axios.put('/api/v1/users/' + this.user.id, {
                name: this.user.name,
                email: this.user.email,
                role_id: this.user.role_id
            }).then( () => {
                toast.fire({
                    icon: 'success',
                    title: 'تم تحديث معلومات المستخدم بنجاح'
                })
                this.$router.push('/users');
            }).catch( (error) => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>

<style scoped>

</style>
