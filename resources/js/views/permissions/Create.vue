<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>
                        <span class="">{{ $t('buttons.new_permission')}}</span>
                    </h5>
                    <router-link exact :to="{ name: 'permissions' }" class="ml-auto btn btn-danger btn-sm">
                        {{ $t('actions.cancel') }}
                    </router-link>
                </div>

                <div class="card-body">
                    <form @submit.prevent="createPermission">
                        <div class="form-group">
                            <label for="name">{{ $t('fields.permission')}}</label>
                            <input v-model="name" type="text" id="name" class="form-control" placeholder="مثال: add-building">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ $t('fields.description') }}</label>
                            <input v-model="description" type="text" id="description" class="form-control" placeholder="مثال: اضافة مبنى">
                            <div v-if="errors && errors.description">
                                <div v-for="error in errors.description"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">{{ $t('buttons.create')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref, toRefs} from "vue";
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const i18n = useI18n()
        const router = useRouter()
        const fields = reactive({
            name: "",
            description: ""
        })
        const errors = ref([])

        function createPermission() {
            axios.post("/api/v1/permissions", fields).then( () => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.created_successfully')
                })
                router.push('/permissions');
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            })
        }

        return {
            ...toRefs(fields),
            errors,
            createPermission
        }
    }
}
</script>

<style scoped>

</style>
