<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0">{{ $t('titles.contact_us') }}</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save">
                        <div class="form-group">
                            <label for="name">{{ $t('fields.name') }}*</label>
                            <input v-model="name" type="text" class="form-control" id="name">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ $t('fields.email') }}</label>
                            <input v-model="email" type="email" class="form-control" id="email" :placeholder="$t('placeholders.email_is_optional')">
                            <div v-if="errors && errors.email">
                                <div v-for="error in errors.email"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ $t('fields.address') }}*</label>
                            <input v-model="title" type="text" class="form-control" id="title">
                            <div v-if="errors && errors.title">
                                <div v-for="error in errors.title"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body">{{ $t('fields.content') }}*</label>
                            <textarea v-model="body" class="form-control" id="body" rows="5"></textarea>
                            <div v-if="errors && errors.body">
                                <div v-for="error in errors.body"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ $t('buttons.send') }}</button>
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
        const router = useRouter()
        const i18n = useI18n()
        const fields = reactive({
            name: "",
            title: "",
            email: "",
            body: "",
        })
        const errors = ref([]);

        const save = () => {
            axios.post("/api/v1/contacts", fields).then( () => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.created_successfully')
                })
                router.push('/');

            }).catch(error => {
                errors.value = error.response.data.errors;
            })
        }

        return {
            ...toRefs(fields),
            errors,
            save
        }
    }
}

</script>

<style scoped></style>
