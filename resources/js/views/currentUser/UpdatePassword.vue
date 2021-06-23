<template>
    <div class="row pb-5">
        <div class="card-body bg-white">
            <h4 class="">{{ $t('titles.change_my_password') }}</h4><hr>
            <form @submit.prevent="updatePassword">
                <div class="form-group row">
                    <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ $t('fields.curren_password') }}</label>
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
                    <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ $t('fields.new_password') }}</label>
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
                    <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">{{ $t('fields.password_confirmation') }}</label>
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
                        <button type="submit" class="btn btn-primary">{{ $t('buttons.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {reactive, ref, toRefs} from "vue";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const i18n = useI18n();
        const fields = reactive({
            current_password: "",
            new_password: "",
            new_password_confirmation: "",
        })
        const errors = ref([])

        function updatePassword() {
            axios.post('/api/v1/user/update/password', {
                'current_password': fields.current_password,
                'new_password': fields.new_password,
                'new_password_confirmation': fields.new_password_confirmation
            }).then(response => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.updated_successfully')
                })
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }else {
                    console.log("Error!")
                }

            })
        }

        return {
            ...toRefs(fields),
            errors,
            updatePassword
        }
    }
}
</script>

<style scoped>

</style>
