<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>
                        <span class="">{{ $t('titles.creation_new_building') }}</span>
                    </h5>
                    <router-link exact :to="{ name: 'buildings' }" class="ml-auto btn btn-danger btn-sm">
                        {{ $t('actions.cancel') }}
                    </router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createBuilding">
                        <div class="form-group">
                            <label for="name">{{ $t('fields.building_name') }}</label>
                            <input v-model="name" type="text" id="name" class="form-control">
                            <div v-if="errors && errors.name">
                                <div v-for="error in errors.name"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number">{{ $t('fields.building_number') }}</label>
                            <input v-model="number" type="text" id="number" class="form-control">
                            <div v-if="errors && errors.number">
                                <div v-for="error in errors.number"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userId">{{ $t('fields.inspector') }}</label>
                            <select v-model="user_id" id="userId" class="form-control">
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
                            <label for="periodId">{{ $t('fields.period') }}</label>
                            <select v-model="period_id" id="periodId" class="form-control">
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
                            <input v-model="notes" type="text" id="notes" class="form-control">
                            <div v-if="errors && errors.notes">
                                <div v-for="error in errors.notes"
                                     class="text-danger" role="alert">
                                    <p>{{ error }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">
                                {{ $t('buttons.create_new_building') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref, toRefs} from "vue";
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const router = useRouter()
        const i18n = useI18n()
        const {users, loadUsers} = useUsers()
        const {periods, loadPeriods} = usePeriods()

        const fields = reactive({
            name: "",
            number: "",
            user_id: "",
            status: "",
            notes: "",
            period_id: "",
            checked_at: "",
        });

        const errors = ref({});
        const form_submitting = ref(false);

        loadPeriods();
        loadUsers();

        const createBuilding = () => {
            axios.post("/api/v1/buildings", fields).then(response => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.created_successfully')
                })
                router.push({name: 'buildings'});
            }).catch(error => {
                errors.value = error.response.data.errors;
            })
        };

        return {
            ...toRefs(fields),
            users,
            periods,
            errors,
            form_submitting,
            loadPeriods,
            createBuilding
        }
    }
}
</script>

<style scoped></style>
