<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex mb-3">
                <router-link exact :to="{name: 'users'}"
                             class="ml-auto btn btn-primary btn-sm">
                    {{ $t('actions.back') }}
                </router-link>
            </div>
            <div class="card shadow">
                <div class="p-3 d-flex">
                    <h4>{{ $t('titles.edit_user_information') }}</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateUser">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ $t('fields.name') }}
                            </label>
                            <div class="col-md-8">
                                <input v-model="name" id="name" type="text" class="form-control">

                                <div v-if="errors">
                                    <span v-for="error in errors.name" class="text-danger" role="alert">
                                        {{ error }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                {{ $t('fields.email') }}
                            </label>
                            <div class="col-md-8">
                                <input v-model="email" id="email" type="email" class="form-control">

                                <div v-if="errors">
                                    <span v-for="error in errors.email" class="text-danger" role="alert">
                                        {{ error }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roleId" class="col-md-4 col-form-label text-md-right">
                                {{ $t('fields.role') }}
                            </label>
                            <div class="col-md-8">
                                <select v-model="role_id" id="roleId" class="form-control">
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
                                    {{ $t('buttons.update') }}
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
import {computed, reactive, ref, toRefs} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const store = useStore()
        const router = useRouter()
        const route = useRoute()
        const i18n = useI18n();
        const fields = reactive({
            name: '',
            email: '',
            role_id: '',
        })
        const errors = ref([])
        const roles = computed(() => { return store.state.user.roles })
        store.dispatch('user/getRoles')

        function loadUser() {
            axios.get(`/api/v1/users/${route.params.id}`).then(response => {
                fields.name = response.data.user.name;
                fields.email = response.data.user.email;
                fields.role_id = response.data.user.role_id;
            })
        }

        loadUser()

        function updateUser() {
            axios.put('/api/v1/users/' + route.params.id, fields).then(() => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.updated_successfully')
                })
                router.push({name: 'users'});
            }).catch((error) => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            })
        }

        return {
            ...toRefs(fields),
            errors,
            roles,
            updateUser
        }

    }
}
</script>

<style scoped>

</style>
