<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="d-flex mb-3">
                    <router-link exact :to="{ name: 'users' }" class="ml-auto btn btn-danger btn-sm">
                        {{ $t('actions.cancel') }}
                    </router-link>
                </div>
                <div class="card">
                    <div class="card-header">
                        <span>{{ $t('titles.add_new_user') }}</span>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="create">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{$t('fields.name') }}</label>
                                <div class="col-md-6">
                                    <input v-model="name" id="name" type="text" class="form-control">
                                    <div v-if="errors && errors.name">
                                        <div v-for="error in errors.name"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username"
                                       class="col-md-4 col-form-label text-md-right">{{ $t('fields.username') }}</label>
                                <div class="col-md-6">
                                    <input v-model="username" id="username" type="text" class="form-control">
                                    <div v-if="errors && errors.username">
                                        <div v-for="error in errors.username"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ $t('fields.email') }}
                                </label>
                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control">
                                    <div v-if="errors && errors.email">
                                        <div v-for="error in errors.email"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ $t('fields.password') }}
                                </label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control">
                                    <div v-if="errors && errors.password">
                                        <div v-for="error in errors.password"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    {{$t('fields.password_confirmation') }}
                                </label>
                                <div class="col-md-6">
                                    <input v-model="password_confirmation" id="password-confirm" type="password"
                                           class="form-control" name="password_confirmation">
                                    <div v-if="errors && errors.password_confirmation">
                                        <div v-for="error in errors.password_confirmation"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 offset-md-4">
                                    <button type="submit"
                                            :class="form_submitting ? 'btn btn-secondary' : 'btn btn-primary'"
                                            v-text="form_submitting ? $t('messages.creating') : $t('buttons.create')"
                                            :disabled="form_submitting"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, toRefs} from "vue";
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const router = useRouter()
        const i18n = useI18n();
        const fields = reactive({
            name: "",
            username: "",
            email: "",
            password: "",
            password_confirmation: "",
            errors: [],
            form_submitting: false
        })

        function create() {
            fields.form_submitting = true;
            axios.post("/api/v1/users", {
                name: fields.name,
                username: fields.username,
                email: fields.email,
                password: fields.password,
                password_confirmation: fields.password_confirmation
            }).then(response => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.created_successfully')
                })
                router.push({name: 'users'})
                fields.form_submitting = false;
            }).catch(error => {
                fields.errors = error.response.data.errors;
                fields.form_submitting = false;
            })
        }

        return {
            ...toRefs(fields),
            create
        }
    }
}
</script>

<style scoped>

</style>
