<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex">
                    <h5> {{ $t('titles.edit_building') }}
                        (<span class="text-success" v-text="name"></span>)
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
                            <input v-model="currentName" type="text" id="name" class="form-control">
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
                            <input v-model="currentNumber" id="number" class="form-control">
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
                            <select v-model="currentUserId" id="user_id" class="form-control">
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
                            <select v-model="currentPeriodId" id="period_id" class="form-control">
                                <option value="">-- {{ $t('fields.choose') }} --</option>
                                <option v-for="period in periods" :value="period.id">{{ period.period }}</option>
                            </select>
                        </div>
                        <!-- status -->
                        <div class="form-group">
                            <label for="status">{{ $t('fields.status') }}</label>
                            <select v-model="currentStatus" id="status" class="form-control">
                                <option value="0">{{ $t('fields.expired') }}</option>
                                <option value="1">{{ $t('fields.valid') }}</option>
                            </select>
                        </div>
                        <!-- notes -->
                        <div class="form-group">
                            <label for="notes">{{ $t('fields.note') }}</label>
                            <input v-model="currentNotes" type="text" id="notes" class="form-control">
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
import {reactive, ref, toRefs} from "vue";
import {useI18n} from "vue-i18n/index";
import {useRouter, useRoute} from 'vue-router'
import usePeriods from "../../modules/period";
import useUsers from "../../modules/users";

export default {
    setup() {
        const i18n = useI18n();
        const router = useRouter();
        const route = useRoute();
        const {periods, loadPeriods} = usePeriods();
        const {users, loadUsers} = useUsers()

        let form_submitting = ref(false)
        const errors = ref([]);
        const currentName = ref("")
        const currentNumber = ref("")
        const currentUserId = ref("")
        const currentStatus = ref("")
        const currentNotes = ref("")
        const currentPeriodId = ref("")
        const currentCheckedAt = ref("")

        let fields = reactive({
            name: "",
            number: "",
            user_id: "",
            status: "",
            notes: "",
            period_id: "",
            checked_at: "",
        })

        loadBuilding();
        loadUsers();
        loadPeriods()

        function loadBuilding() {
            axios.get(`/api/v1/buildings/${route.params.id}`).then(response => {
                fields = response.data.building;
                currentName.value = fields.name
                currentNumber.value = fields.number
                currentUserId.value = fields.user_id
                currentStatus.value = fields.status
                currentNotes.value = fields.notes
                currentPeriodId.value = fields.period_id
                currentCheckedAt.value = fields.checked_at
            })
        }

        function update_building() {
            form_submitting = true;
            axios.put(`/api/v1/buildings/${route.params.id}`, {
                name: currentName.value,
                number: currentNumber.value,
                user_id: currentUserId.value,
                status: currentStatus.value,
                notes: currentNotes.value,
                period_id: currentPeriodId.value,
                checked_at: currentCheckedAt.value,
            }).then(response => {
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
            ...toRefs(fields),
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
