<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $t('password_creation') }}</div>

                    <div class="card-body">
                        <form @submit.prevent="set_password">
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ $t('fields.password') }}</label>

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
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ $t('password_confirm')}}</label>
                                <div class="col-md-6">
                                    <input v-model="password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    <div v-if="errors && errors.password_confirmation">
                                        <div v-for="error in errors.password_confirmation"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $t('save') }}
                                    </button>
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
import {ref} from "vue";

export default {
    setup() {
        let password = ref("");
        let password_confirmation = ref("");
        let errors = ref([]);

        function set_password() {
            let fields = {'password': password, 'password_confirmation': password_confirmation}

            axios.post("/api/v1/set-password", fields).then(response => {
                if (response.data.token.access_token) {
                    localStorage.setItem('authToken', response.data.token.access_token)
                    toast.fire({
                        icon: 'success',
                        title: 'تم تعيين كلمة المرور بنجاح'
                    })
                    window.location.replace('/')
                }
            }).catch(error => {
                errors.value = error.response.data.errors;
            })
        }

        return {
            password,
            password_confirmation,
            errors,
            set_password
        }
    },
}
</script>

<style scoped>

</style>
