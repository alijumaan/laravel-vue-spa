<template>
    <div>
        <div class="card mb-3">
            <div class="card-header d-flex">
                {{ title }}
                <router-link exact :to="{name: 'pages'}" class="ml-auto btn btn-danger btn-sm">
                    {{ $t('actions.cancel') }}
                </router-link>
            </div>
            <div class="card-body">
                <div class="container">
                    <form @submit.prevent="update_page" enctype="multipart/form-data">

                        <div class="col-lg-5 form-group">
                            <label> {{ $t('fields.title') }} </label>
                            <input type="text" class="form-control" v-model="title">
                        </div>

                        <div class="col-lg-5 form-group">
                            <label> {{ $t('fields.url') }} </label>
                            <input type="text" class="form-control" v-model="slug">
                        </div>

                        <div class="col-lg-12 form-group">
                            <label> {{ $t('fields.content') }} </label>

                            <ckeditor :editor="editor" v-model="content" :config="editorConfig"></ckeditor>
                        </div>

                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-primary mt-3">{{ $t('buttons.update') }}</button>
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
            title: '',
            slug: '',
            content: '',
            errors: {},
            editor: ClassicEditor,
            editorConfig: {
                // toolbar: [ 'bold', 'italic', '|', 'link', 'undo', 'redo'],
                language: 'ar'
            },
            editorDisabled: true,
        }
    },
    mounted() {
        this.loadPage();
    },
    methods: {
        loadPage() {
            axios.get(`/api/v1/pages/${this.$route.params.id}`).then(response => {
                this.title = response.data.page.title
                this.slug = response.data.page.slug
                this.content = response.data.page.content
            })
        },
        update_page() {
            axios.put(`/api/v1/pages/${this.$route.params.id}`, {
                title: this.title,
                slug: this.slug,
                content: this.content,
            }).then(response => {
                toast.fire({
                    icon: 'success',
                    title: this.$i18n.t('messages.updated_successfully')
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
