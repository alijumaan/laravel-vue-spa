<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0">{{ $t('titles.contact_us') }}</h4>
                </div>

                <div class="card-body">
                    <form @submit.prevent="sendMessage">
                        <div class="form-group">
                            <label for="name">{{ $t('fields.name') }}*</label>
                            <input v-model="fields.name" type="text" class="form-control" id="name">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ $t('fields.email') }}</label>
                            <input v-model="fields.email" type="email" class="form-control" id="email" :placeholder="$t('placeholders.email_is_optional')">
                            <div v-if="errors && errors.email">
                                <div v-for="error in errors.email"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ $t('fields.address') }}*</label>
                            <input v-model="fields.title" type="text" class="form-control" id="title">
                            <div v-if="errors && errors.title">
                                <div v-for="error in errors.title"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body">{{ $t('fields.content') }}*</label>
                            <textarea v-model="fields.body" class="form-control" id="body" rows="5"></textarea>
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
export default {
    data() {
        return {
            fields: {
                name: "",
                title: "",
                email: "",
                body: "",
            },
            errors: {},
        }
    },
    methods: {
        sendMessage() {
            axios.post("/api/v1/contacts", this.fields).then( () => {
                toast.fire({
                    icon: 'success',
                    title: 'تم الإرسال بنجاح'
                })
                this.$router.push('/');
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        },
    }
}

</script>

<style scoped></style>
