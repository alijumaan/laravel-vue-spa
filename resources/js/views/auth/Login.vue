<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow bg-transparent text-white">
                    <div class="card-header border-0">تسجيل الدخول</div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">اسم المستخدم</label>
                                <div class="col-md-6">
                                    <input v-model="loginData.username" id="username" type="text" class="form-control">
                                    <div v-if="errors && errors.username">
                                        <div v-for="error in errors.username"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">كلمة المرور</label>
                                <div class="col-md-6">
                                    <input v-model="loginData.password" id="password" :type="fieldType"
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
                                            تذكرني
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success"
                                            :value="form_submitting ? 'يرجى الإنتظار..' : 'دخول'"
                                            :disabled="form_submitting">
                                        دخول
                                    </button>
                                    <a class="btn btn-link text-white" href="#">
                                        هل نسيت كلمة المرور ؟
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
export default {
    beforeRouteEnter(to, from, next) {
        if (localStorage.getItem("authToken")) {
            return next({name: 'home'})
        }
        next();
    },
    data() {
        return {
            fieldType: 'password',
            errors: [],
            form_submitting: false,
            loginData: {
                username: "",
                password: ""
            }
        }
    },

    methods: {
        login() {
            axios.post("/api/v1/login", this.loginData).then(response => {

                if (response.data.token.access_token) {
                    this.form_submitting = true;

                    localStorage.setItem('authToken', response.data.token.access_token)

                    toast.fire({
                        icon: 'success',
                        title: 'تم تسجيل الدخول بنجاح'
                    })

                    window.location.replace('/')

                    this.form_submitting = false;
                }
            }).catch(error => {
                this.errors = error.response.data.errors;
                this.form_submitting = false;
            })
        },
        switchField() {
            this.fieldType = this.fieldType === 'password' ? 'test' : 'password';
        }
    },
}
</script>

<style scoped>

</style>
