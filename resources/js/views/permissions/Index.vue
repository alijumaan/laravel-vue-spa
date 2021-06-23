<template>

    <div class="col-md-12">
        <div class="card shadow">
            <form @submit.prevent="saveRolePermission">
                <div class="card-header d-flex">

                    <select v-model="role_id" @change="checkPermissionByRoleId(role_id)" class="form-control w-50">
                        <option disabled value="">-- {{ $t('fields.choose') }} --</option>
                        <option v-for="role in roles" :value="role.id">{{ role.role }}</option>
                    </select>

                    <router-link v-if="isAdmin" :to="{ name: 'permissions.create'}"
                                 class="ml-auto btn btn-primary btn-sm">
                        <i class="fa fa-plus fa-fw"></i>
                        {{ $t('buttons.new_permission')}}
                    </router-link>

                </div>
                <div class="card-body row">

                    <div class="col-lg-4" v-for="permission in permissions">
                        <input class="m-2" id="checkbox" type="checkbox" :value="permission.id" v-model="permissionId"
                               :checked="checked">
                        <label for="checkbox">{{ permission.description }}</label>
                    </div>

                </div>
                <div class="card-footer small text-muted">
                    <input type="submit" class="btn btn-primary" name="" :value="$t('buttons.save')">
                </div>
            </form>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            permissions: [],
            roles: [],
            permissionId: [],
            role_id: "",
            checked: false,
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.loadPermissions();
    },
    methods: {
        loadPermissions() {
            axios.get('/api/v1/permissions').then(response => {
                this.permissions = response.data.permissions
                this.roles = response.data.roles
            });
        },
        saveRolePermission() {
            axios.post('/api/v1/permission-role', {
                role_id: this.role_id,
                permission: this.permissionId
            }).then(() => {
                toast.fire({
                    icon: 'success',
                    title: this.$i18n.t('messages.created_successfully')
                })
            });
        },
        checkPermissionByRoleId(roleId) {
            axios.post('/api/v1/permission-role/' + roleId).then(response => {
                $('input[type=checkbox]').each(function () {
                    let ThisVal = parseInt(this.value);
                    this.checked = response.data.permissions.includes(ThisVal);
                });
            });
        },
    }
}
</script>

<style scoped>
</style>
