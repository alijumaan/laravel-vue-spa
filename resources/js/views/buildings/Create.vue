<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>
                        <span class="">{{ $t('titles.building_creation')}}</span>
                    </h5>
                    <router-link exact :to="{ name: 'buildings' }" class="ml-auto btn btn-danger btn-sm">
                        {{ $t('actions.cancel') }}
                    </router-link>
                </div>

                <div class="card-body">
                    <form @submit.prevent="create_building">
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

                        <div class="form-group">
                            <label for="number">{{ $t('fields.building_number') }}</label>
                            <input v-model="fields.number" type="text" id="number" class="form-control">
                            <div v-if="errors && errors.number">
                                <div v-for="error in errors.number"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userId">{{ $t('fields.inspector')}}</label>
                            <select v-model="fields.user_id" id="userId" class="form-control">
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

                        <div class="form-group">
                            <label for="periodId">{{ $t('fields.period')}}</label>
                            <select v-model="fields.period_id" id="periodId" class="form-control">
                                <option value="">-- {{ $t('fields.choose') }} --</option>
                                <option v-for="period in periods" :value="period.id">{{ period.period }}</option>
                            </select>
                            <div v-if="errors && errors.period_id">
                                <div v-for="error in errors.period_id"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>

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
                            <button type="submit" name="submit" class="btn btn-primary">{{ $t('buttons.create_building') }}</button>
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
        this.loadUsers();
        this.loadPeriod();
    },
    methods: {
        loadUsers() {
            axios.get('/api/v1/users').then(response => {
                this.users = response.data.users
            })
        },
        loadPeriod() {
            axios.get('/api/v1/periods').then(response => {
                this.periods = response.data.periods;
            })
        },
        create_building() {
            axios.post("/api/v1/buildings", this.fields).then(response => {
                toast.fire({
                    icon: 'success',
                    title: 'تم الإنشاء بنجاح'
                })
                this.$router.push('/buildings');
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>

<style scoped></style>
