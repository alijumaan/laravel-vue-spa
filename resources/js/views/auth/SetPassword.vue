<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">إنشاء كلمة مرور</div>

                    <div class="card-body">
                        <form @submit.prevent="set_password">
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">كلمة المرور</label>

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
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كلمة المرور</label>
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
                                        حفظ كلمة المرور
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
export default {
    data() {
        return {
            password: "",
            password_confirmation: "",
            errors: []
        }
    },
    methods: {
        set_password() {
            let fields = {'password': this.password, 'password_confirmation': this.password_confirmation}
            axios.post("/api/v1/set-password", fields).then(response => {

                console.log(response.data)

                if (response.data.token.access_token) {

                    localStorage.setItem('authToken', response.data.token.access_token)

                    toast.fire({
                        icon: 'success',
                        title: 'تم تعيين كلمة المرور بنجاح'
                    })

                    window.location.replace('/')
                }


            }).catch(error => {
                console.log(error.response.data.error)
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>

<style scoped>

</style>
