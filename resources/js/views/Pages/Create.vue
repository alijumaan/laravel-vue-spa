<template>
    <div>
        <div class="card mb-3">
            <div class="card-header d-flex">
                انشاء صحفة جديدة
                <router-link exact :to="{name: 'pages'}" class="ml-auto btn btn-danger btn-sm">
                    إلغاء
                </router-link>
            </div>
            <div class="card-body">
                <div class="container">
                    <form @submit.prevent="create_page">

                        <div class="col-lg-5 form-group">
                            <label> العنوان </label>
                            <input type="text" class="form-control" v-model="fields.title">
                            <div v-if="errors && errors.title">
                                <div v-for="error in errors.title"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 form-group">
                            <label> Url </label>
                            <input type="text" class="form-control" v-model="fields.slug">
                            <div v-if="errors && errors.slug">
                                <div v-for="error in errors.slug"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 form-group">
                            <label> المحتوى </label>

                            <ckeditor :editor="editor" v-model="fields.content" :config="editorConfig"></ckeditor>
                            <div v-if="errors && errors.content">
                                <div v-for="error in errors.content"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-primary mt-3">إنشاء </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    data() {
        return {
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
        }
    },
    methods: {
        create_page() {
            axios.post("/api/v1/pages", this.fields).then( () => {
                toast.fire({
                    icon: 'success',
                    title: 'تم إنشاء الصفحة بنجاح'
                })
                this.$router.push({name: 'pages'})
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }
}

</script>

<style scoped></style>
