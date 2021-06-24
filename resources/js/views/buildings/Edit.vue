<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex">
                    <h5> {{ $t('titles.edit_building') }}
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
import {computed, reactive, ref, toRefs} from "vue";
import {useI18n} from "vue-i18n/index";
import {useRouter, useRoute} from 'vue-router'
import {useStore} from "vuex";

export default {
    setup() {
        const i18n = useI18n();
        const router = useRouter();
        const route = useRoute();
        const store = useStore()

        let form_submitting = ref(false)
        const errors = ref([]);
        const currentName = ref("")
        const currentNumber = ref("")
        const currentUserId = ref("")
        const currentStatus = ref("")
        const currentNotes = ref("")
        const currentPeriodId = ref("")
        const currentCheckedAt = ref("")


        let state = reactive({
            fields: {
                name: "",
                number: "",
                user_id: "",
                status: "",
                notes: "",
                period_id: "",
                checked_at: "",
            }
        })

        const users = computed(() => { return store.state.user.users})
        if (store.state.loaded_users === true) {
            store.dispatch('user/getUsers')
            store.state.loaded_users = false
        }

        loadBuilding();
        const periods = computed(() => { return store.state.period.periods})
        if (store.state.loaded_periods === true) {
            store.dispatch('period/getPeriods')
            store.state.loaded_periods = false
        }

        function loadBuilding() {
            axios.get(`/api/v1/buildings/${route.params.id}`).then(response => {
                state.fields = response.data.building;
            })
        }

        function update_building() {
            form_submitting = true;
            axios.put(`/api/v1/buildings/${route.params.id}`, state.fields).then(response => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.updated_successfully')
                })
                router.push('/buildings');
                form_submitting = false;
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
                form_submitting = false;
            })
        }

        return {
            ...toRefs(state),
            users,
            periods,
            errors,
            form_submitting,
            update_building,
            currentName,
            currentNumber,
            currentUserId,
            currentStatus,
            currentNotes,
            currentPeriodId,
            currentCheckedAt,
        }
    },
}
</script>
