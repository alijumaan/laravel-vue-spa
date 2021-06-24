<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>
                        <span class="">{{ $t('titles.create_new_link') }}</span>
                    </h5>
                    <router-link exact :to="{ name: 'links' }" class="ml-auto btn btn-danger btn-sm">
                        {{ $t('actions.cancel') }}
                    </router-link>
                </div>

                <div class="card-body">
                    <form @submit.prevent="createLink">
                        <div class="form-group">
                            <label for="name">{{ $t('fields.name') }}</label>
                            <input v-model="name" type="text" id="name" class="form-control"
                                   :placeholder="$t('placeholders.ex_homepage')">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="number">Url</label>
                            <input v-model="to" type="text" id="number" class="form-control"
                                   :placeholder="$t('placeholders.ex_/home')">
                            <div v-if="errors && errors.to">
                                <div v-for="error in errors.to"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="icon">{{ $t('fields.icon') }}</label>
                            <input v-model="icon" type="text" id="icon" class="form-control"
                                   :placeholder="$t('placeholders.ex_home')">
                            <div v-if="errors && errors.icon">
                                <div v-for="error in errors.icon"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userId">{{ $t('fields.status') }}</label>
                            <select v-model="access" id="userId" class="form-control">
                                <option value="">-- {{ $t('fields.choose') }} --</option>
                                <option value="1">{{ $t('fields.show') }}</option>
                                <option value="0">{{ $t('fields.hide') }}</option>
                            </select>
                            <div v-if="errors && errors.access">
                                <div v-for="error in errors.access"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">{{ $t('buttons.create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {reactive, ref, toRefs} from "vue";
import {useI18n} from "vue-i18n/index";
import {useRouter} from "vue-router";
import {useStore} from "vuex";

export default {
    setup() {
        const i18n = useI18n()
        const router = useRouter()
        const store = useStore()
        const fields = reactive({
            name: "",
            to: "",
            icon: "",
            access: ""
        })
        const errors = ref([])

        function createLink() {
            axios.post("/api/v1/links", fields).then(() => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.created_successfully')
                })
                store.dispatch('link/getLinks')
                router.push({name: 'links'});
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            })
        }

        return {
            ...toRefs(fields),
            createLink,
            errors
        }
    }
}
</script>

<style scoped>

</style>
