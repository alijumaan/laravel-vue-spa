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
                    <form @submit.prevent="updateLink">
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
import {useRoute, useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";
import {reactive, toRefs} from "vue";

export default {
    setup() {
        const i18n = useI18n()
        const router = useRouter()
        const route = useRoute()
        const state = reactive({
            fields: {
                name: "",
                to: "",
                icon: "",
                access: ""
            },
            errors: []
        })

        function loadLinks() {
            axios.get('/api/v1/links/' + route.params.id).then(response => {
                state.fields = response.data.link;
            })
        }

        loadLinks()

        function updateLink() {
            axios.put(`/api/v1/links/${route.params.id}`, state.fields).then( () => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.updated_successfully')
                })
                router.push('/links');
            }).catch( error => state.errors = error.response.data.errors)
        }

        return {
            ...toRefs(state),
            updateLink,
        }
    }
}
</script>

<style scoped></style>
