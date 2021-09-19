<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-custom shadow text-white">
                    <div class="card-body my-4">
                        <form @submit.prevent="login">
                            <div class="form-group row">
                                <label for="username"
                                       class="col-md-4 col-form-label text-md-right">{{ $t('fields.username') }}</label>
                                <div class="col-md-6">
                                    <div v-if="errors && errors.error">
                                        <div class="alert alert-danger">
                                            <ul v-for="error in errors.error">
                                                <li style="list-style-type:none;">{{ error }}</li>
                                            </ul>
                                        </div>
                                    </div>
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
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ $t('fields.password') }}</label>
                                <div class="col-md-6">
                                    <input v-model="password" id="password" :type="fieldType"
                                           class="form-control">
                                    <div v-if="errors && errors.password">
                                        <div v-for="error in errors.password"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <i @click="switchField"
                                       :class="fieldType === 'password' ? 'far fa-eye' : 'fas fa-eye-slash'"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            {{ $t('fields.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                            :value="form_submitting ? $t('fields.please_wait') : $t('buttons.login')"
                                            :disabled="form_submitting">
                                        {{ $t('buttons.login') }}
                                    </button>
                                    <a class="btn btn-link text-white" href="#">
                                        <small>{{ $t('fields.forget_password?') }}</small>
                                    </a>
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
import {reactive, ref, toRefs} from "vue";
import {useI18n} from "vue-i18n/index";

export default {
    beforeRouteEnter(to, from, next) {
        if (localStorage.getItem("authToken")) {
            return next({name: 'home'})
        }
        next();
    },
    setup() {
        const i18n = useI18n()

        let fieldType = ref("password");
        let errors = ref({});
        let form_submitting = false;
        const loginData = reactive({
            username: "",
            password: ""
        });

        function login() {
            axios.post("/api/v1/login", loginData).then(response => {
                if (response.data.token.access_token) {
                    form_submitting = true;
                    localStorage.setItem('authToken', response.data.token.access_token)
                    toast.fire({
                        icon: 'success',
                        title: i18n.t('messages.login_successfully')
                    })
                    window.location.replace('/')
                    form_submitting = false;
                }
            }).catch(error => {
                errors.value = error.response.data.errors;
                form_submitting = false;
            })
        }

        function switchField() {
            fieldType.value = fieldType.value === 'password' ? 'text' : 'password';
        }

        return {
            ...toRefs(loginData),
            fieldType,
            errors,
            form_submitting,
            login,
            switchField
        }
    }
}
</script>

<style scoped>
.border-blue{
    border-color: #4684bb;
}
.card-custom{
    border-radius: .25rem;
    background-color: #343a3e;
    border: 1px solid #4684bb;
}
</style>
