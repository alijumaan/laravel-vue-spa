<template>

    <div class="col-md-12">
        <div class="card shadow">
            <form @submit.prevent="saveRolePermission">
                <div class="card-header d-flex">

                    <select v-model="role_id" @change="checkPermissionByRoleId(role_id)" class="form-control w-50">
                        <option disabled value="">-- {{ $t('fields.choose') }} --</option>
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.role }}</option>
                    </select>
                    <router-link v-if="isAdmin" :to="{ name: 'permissions.create'}" class="ml-auto">
                        <span class=" btn btn-primary btn-sm">
                            <i class="fa fa-plus fa-fw"></i>
                            {{ $t('buttons.new_permission') }}
                        </span>
                    </router-link>

                </div>
                <div class="card-body row">

                    <div class="col-lg-4" v-for="permission in permissions" :key="permission.id">
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
import {computed, reactive, toRefs} from "vue";
import {useStore} from "vuex";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const store = useStore()
        const i18n = useI18n()
        const state = reactive({
            permissionId: [],
            role_id: "",
            checked: false,
        });

        const isAdmin = computed(() => {
            return store.state.currentUser.isAdmin
        })

        const permissions = computed(() => {
            return store.state.permission.permissions
        })
        const roles = computed(() => {
            return store.state.permission.roles
        })
        if (store.state.loaded_permissions === true) {
            store.dispatch('permission/getPermissions')
            store.state.loaded_permissions = false
        }

        function saveRolePermission() {
            axios.post('/api/v1/permission-role', {
                role_id: state.role_id,
                permission: state.permissionId
            }).then(() => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.created_successfully')
                })
            });
        }

        return {
            ...toRefs(state),
            isAdmin,
            permissions,
            roles,
            saveRolePermission
        }
    },

    methods: {
        checkPermissionByRoleId(roleId) {
            axios.post('/api/v1/permission-role/' + roleId).then(response => {
                $('input[type=checkbox]').each(function () {
                    let ThisVal = parseInt(this.value);
                    this.checked = response.data.permissions.includes(ThisVal);
                });
            });
        }
    }
}
</script>

<style scoped>
</style>
