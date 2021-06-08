<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex">
                    <h5>{{ $t('titles.edit_link')}} (<span class="text-success" v-text="fields.name"></span>)</h5>

                    <router-link exact :to="{name: 'links'}" class="ml-auto btn btn-primary btn-sm">
                        {{  $t('actions.back') }}
                    </router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update_link">
                        <!-- name -->
                        <div class="form-group">
                            <label for="name">{{ $t('fields.name') }}</label>
                            <input v-model="fields.name" type="text" id="name" class="form-control">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Url -->
                        <div class="form-group">
                            <label for="number">Url</label>
                            <input v-model="fields.to" type="text" id="number" class="form-control">
                            <div v-if="errors && errors.to">
                                <div v-for="error in errors.to"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Icon -->
                        <div class="form-group">
                            <label for="icon">{{ $t('fields.icon') }}</label>
                            <input v-model="fields.icon" type="text" id="icon" class="form-control">
                            <div v-if="errors && errors.icon">
                                <div v-for="error in errors.icon"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Access -->
                        <div class="form-group">
                            <label for="userId">{{ $t('fields.status') }}</label>
                            <select v-model="fields.access" id="userId" class="form-control">
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
                            <input class="btn btn-primary" type="submit" :value="$t('buttons.update')"/>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div></template>

<script>
export default {
    data() {
        return {
            fields: {
                "name": "",
                "to": "",
                "icon": "",
                "access": ""
            },
            errors: {},
        }
    },
    created() {
        this.getLink();
    },
    methods: {
        getLink() {
            axios.get('/api/v1/links/' + this.$route.params.id).then(response => {
                this.fields = response.data.link;
            })
        },
        update_link() {
            axios.put(`/api/v1/links/${this.fields.id}`, this.fields).then( () => {
                toast.fire({
                    icon: 'success',
                    title: this.$i18n.t('messages.updated_successfully')
                })
                this.$router.push('/links');
            }).catch( error => this.errors = error.response.data.errors)
        }
    }
}
</script>

<style scoped></style>
