<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex">
                    <h5> {{ $t('titles.edit_building')}}
                        (<span class="text-success" v-text="fields.name"></span>)
                    </h5>

                    <router-link exact :to="{name: 'buildings.show'}" class="ml-auto btn btn-primary btn-sm">
                        {{ $t('actions.cancel') }}
                    </router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update_building">
                        <!-- name -->
                        <div class="form-group">
                            <label for="name">{{ $t('fields.building_name') }}</label>
                            <input v-model="fields.name" type="text" id="name" class="form-control">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- number -->
                        <div class="form-group">
                            <label for="number">{{ $t('fields.building_number') }}</label>
                            <input v-model="fields.number" id="number" class="form-control">
                            <div v-if="errors && errors.number">
                                <div v-for="error in errors.number"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- user_id -->
                        <div class="form-group">
                            <label for="user_id">{{ $t('fields.inspector') }}</label>
                            <select v-model="fields.user_id" id="user_id" class="form-control">
                                <option value="">-- {{ $t('fields.choose') }} --</option>
                                <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                            </select>
                            <div v-if="errors && errors.user_id">
                                <div v-for="error in errors.user_id"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- period_id -->
                        <div class="form-group">
                            <label for="period_id">{{ $t('fields.period') }}</label>
                            <select v-model="fields.period_id" id="period_id" class="form-control">
                                <option value="">-- {{ $t('fields.choose') }} --</option>
                                <option v-for="period in periods" :value="period.id">{{ period.period }}</option>
                            </select>
                        </div>
                        <!-- status -->
                        <div class="form-group">
                            <label for="status">{{ $t('fields.status') }}</label>
                            <select v-model="fields.status" id="status" class="form-control">
                                <option value="0">{{ $t('fields.expired') }}</option>
                                <option value="1">{{ $t('fields.valid') }}</option>
                            </select>
                        </div>
                        <!-- notes -->
                        <div class="form-group">
                            <label for="notes">{{ $t('fields.note') }}</label>
                            <input v-model="fields.notes" type="text" id="notes" class="form-control">
                            <div v-if="errors && errors.notes">
                                <div v-for="error in errors.notes"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit"
                                   :class="form_submitting ? 'btn btn-secondary' : 'btn btn-primary'"
                                   :value="form_submitting ? $t('messages.please_wait') : $t('buttons.update_building')"
                                   :disabled="form_submitting"/>
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
            users: [],
            periods: {},
            fields: {
                "name": "",
                "number": "",
                "user_id": "",
                "status": "",
                "notes": "",
                "period_id": "",
                "checked_at": "",
            },
            errors: {},
            form_submitting: false
        }
    },
    mounted() {
        this.loadBuilding();
        this.loadUsers();
        this.loadPeriod()
    },
    methods: {
        loadBuilding() {
            axios.get('/api/v1/buildings/' + this.$route.params.id).then(response => {
                this.fields = response.data.building;
            })
        },
        loadUsers() {
            axios.get('/api/v1/users').then(response => {
                this.users = response.data.users;
            })
        },
        loadPeriod() {
            axios.get('/api/v1/periods').then(response => {
                this.periods = response.data.periods;
            })
        },
        update_building() {
            this.form_submitting = true;
            axios.put(`/api/v1/buildings/${this.fields.slug}`, this.fields).then(response => {
                toast.fire({
                    icon: 'success',
                    title: this.$i18n.t('messages.updated_successfully')
                })
                this.$router.push('/buildings');
                this.form_submitting = false;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
                this.errors = error.response.data.errors;
                this.form_submitting = false;
            })
        }
    }
}
</script>

<style scoped>

</style>
