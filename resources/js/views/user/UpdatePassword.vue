<template>
    <div class="row pb-5">
        <div class="card-body bg-white">
            <h4 class="">تغير كلمة المرور</h4><hr>
            <form @submit.prevent="updatePassword">
                <div class="form-group row">
                    <label for="current_password" class="col-md-4 col-form-label text-md-right">كلمة المرور الحالية</label>
                    <div class="col-md-6">
                        <input v-model="current_password" id="current_password" type="password" class="form-control">

                        <div v-if="errors && errors.current_password">
                            <div v-for="error in errors.current_password"
                                 class="text-danger" role="alert">
                                <p>{{ error }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new-password" class="col-md-4 col-form-label text-md-right">كلمة المرور الجديدة</label>
                    <div class="col-md-6">
                        <input v-model="new_password" id="new-password" type="password" class="form-control">

                        <div v-if="errors && errors.new_password">
                            <div v-for="error in errors.new_password"
                                 class="text-danger" role="alert">
                                <p>{{ error }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كلمة المرور</label>
                    <div class="col-md-6">
                        <input v-model="new_password_confirmation" id="new-password-confirm" type="password" class="form-control">

                        <div v-if="errors && errors.new_password_confirmation">
                            <div v-for="error in errors.new_password_confirmation"
                                 class="text-danger" role="alert">
                                <p>{{ error }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">تغير كلمة المرور</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            current_password: "",
            new_password: "",
            new_password_confirmation: "",
            errors: []
        }
    },
    methods: {
        updatePassword() {
            axios.post('/api/v1/user/update/password', {
                'current_password': this.current_password,
                'new_password': this.new_password,
                'new_password_confirmation': this.new_password_confirmation
            }).then(response => {
                toast.fire({
                    icon: 'success',
                    title: 'تم تغير كلمة المرور بنجاح يمكنك استخدامها الان'
                })
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>

<style scoped>

</style>
