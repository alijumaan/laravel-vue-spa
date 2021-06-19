<template>
    <div>
        <div class="card mb-3">
            <div class="card-header d-flex">
                {{ $t('titles.create_new_page') }}
                <router-link exact :to="{name: 'pages'}" class="ml-auto btn btn-danger btn-sm">
                    {{ $t('actions.cancel') }}
                </router-link>
            </div>
            <div class="card-body">
                <div class="container">
                    <form @submit.prevent="create_page">

                        <div class="col-lg-5 form-group">
                            <label> {{ $t('fields.title') }} </label>
                            <input type="text" class="form-control" v-model="fields.title">
                            <div v-if="errors && errors.title">
                                <div v-for="error in errors.title"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 form-group">
                            <label> {{ $t('fields.url') }} </label>
                            <input type="text" class="form-control" v-model="fields.slug">
                            <div v-if="errors && errors.slug">
                                <div v-for="error in errors.slug"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 form-group">
                            <label> {{ $t('fields.content') }} </label>

                            <ckeditor :editor="editor" v-model="fields.content" :config="editorConfig"></ckeditor>
                            <div v-if="errors && errors.content">
                                <div v-for="error in errors.content"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-primary mt-3">{{ $t('buttons.create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {reactive, toRefs} from "vue";
import {useI18n} from "vue-i18n/index";
import {useRouter} from "vue-router";

export default {
    setup(props, context) {
        const i18n = useI18n()
        const router = useRouter()

        const state = reactive({
            fields: {
                title: '',
                slug: '',
                content: ''
            },
            errors: {},
            editor: ClassicEditor,
            editorConfig: {
                language: 'ar'
            },
            editorDisabled: true,
        })

        function create_page() {
            axios.post("/api/v1/pages", state.fields).then(response => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.created_successfully')
                })
                context.emit("getPages");
                router.push({name: 'pages'});
            }).catch(error => {
                if (error.response.status === 422) {
                    state.errors = error.response.data.errors;
                }else {
                    console.log(error)
                }
            })
        }

        return {
            ...toRefs(state),
            create_page
        }

    }
}

</script>

<style scoped></style>
