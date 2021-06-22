<template>
    <div>
        <div class="card shadow">
            <div class="card-header d-flex">
                <h5>
                    <span :class="building.checked_at > now ? 'badge badge-success' : 'badge badge-danger'">
                        {{ building.name }}
                    </span>

                    ({{ building.number }})

                    <span :class="building.checked_at > now ? 'text-success' : 'text-danger'">
                        {{ building.statusText }}
                    </span>
                </h5>
                <router-link exact :to="{name: 'buildings', params: { id: building.slug }}"
                             class="ml-auto btn btn-primary btn-sm">
                    {{ $t('actions.back') }}
                </router-link>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th>{{ $t('fields.inspector') }}</th>
                        <th>{{ $t('fields.from_date') }}</th>
                        <th>{{ $t('fields.expiry_date') }}</th>
                        <th>{{ $t('fields.note') }}</th>
                        <th width="25%">{{ $t('fields.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ building.user }}</td>
                        <td><span class="badge badge-success">{{ building.updated_at }}</span></td>
                        <td><span :class="building.checked_at > now ? 'badge badge-success' : 'badge badge-danger'">{{
                                building.checked_at
                            }}</span></td>
                        <td>{{ building.notes }}</td>
                        <td>
                            <a class="btn btn-sm" data-toggle="modal" data-target="#updateBuilding">
                                <i class="fa fa-edit text-primary mr-1"></i>
                            </a>
                            <router-link
                                v-if="isAdmin"
                                :to="{ name: 'buildings.edit', params: { id: building.slug } }">
                                <i class="fas fa-wrench text-primary"></i>
                            </router-link>
                            <button
                                v-if="isAdmin"
                                @click="delete_building(building.slug)"
                                class="trash">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- modal form start -->
        <div id="updateBuilding" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">{{ $t('titles.edit_building') }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="card-body p-3">
                            <form @submit.prevent="update_building">
                                <!-- status -->
                                <div class="form-group">
                                    <label for="status">{{ $t('fields.status') }}</label>
                                    <select v-model="building.status" id="status" class="form-control">
                                        <option value="0">{{ $t('fields.expired') }}</option>
                                        <option value="1">{{ $t('fields.valid') }}</option>
                                    </select>
                                    <div v-if="errors && errors.status">
                                        <div v-for="error in errors.status"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- period_id -->
                                <div class="form-group">
                                    <label for="period_id">{{ $t('fields.period') }}</label>
                                    <select v-model="building.period_id" id="period_id" class="form-control">
                                        <option value="">-- {{ $t('fields.choose') }} --</option>
                                        <option v-for="period in periods" :value="period.id">
                                            {{ period.period }}
                                        </option>
                                    </select>
                                    <div v-if="errors && errors.period_id">
                                        <div v-for="error in errors.period_id"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- notes -->
                                <div class="form-group">
                                    <label for="notes">{{ $t('fields.note') }}</label>
                                    <input v-model="building.notes" type="text" id="notes" class="form-control">

                                    <div v-if="errors && errors.notes">
                                        <div v-for="error in errors.notes"
                                             class="text-danger" role="alert">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                            :class="form_submitting ? 'btn btn-secondary' : 'btn btn-primary'"
                                            v-text="form_submitting ? $t('updating...') : $t('buttons.update_building')"
                                            :disabled="form_submitting"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-danger" data-dismiss="modal">
                            {{ $t('actions.cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal form ended -->
    </div>
</template>

<script>
import {computed, onMounted, reactive, ref, toRefs} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";
import {useStore} from "vuex";

export default {
    setup() {
        const i18n = useI18n()
        const router = useRouter()
        const route = useRoute()
        const store = useStore();

        const now = new Date().toISOString();
        let errors = ref([]);
        let fields = reactive({
            status: "",
            notes: "",
            period_id: ""
        })
        let form_submitting = false;

        const isAdmin = computed(() => store.state.currentUser.isAdmin);
        const building = computed(() => store.state.building.building);
        const periods = computed(() => store.state.period.periods);

        onMounted(() => {
            getBuilding();
        })

        function getBuilding() {
            store.dispatch('building/getBuilding', {
                param: route.params.id
            });
        }

        function update_building() {
            form_submitting = true;
            axios.put(`/api/v1/buildings/${route.params.id}/quickUpdate`, {
                status: building.value.status,
                period_id: building.value.period_id,
                notes: building.value.notes
            }).then(response => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.updated_successfully')
                })
                // router.push(`/buildings`);
                location.replace('/buildings')
                form_submitting = false;
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
                form_submitting = false;
            })
        }

        function delete_building(building) {
            swal.fire({
                title: i18n.t('messages.are_you_sour?'),
                text: i18n.t('messages.You_wont_be_able_to_undo_this'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: i18n.t('messages.delete_confirmation')
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/v1/buildings/' + building).then(response => {
                        router.push('/buildings');
                    })
                    toast.fire({
                        icon: 'success',
                        title: i18n.t('messages.deleted_successfully')
                    })
                }
            })
        }

        return {
            ...toRefs(fields),
            now,
            errors,
            form_submitting,
            isAdmin,
            building,
            periods,
            getBuilding,
            update_building,
            delete_building
        }
    }
}
</script>

<style scoped>
.trash {
    border: none;
    color: #FF0000;
    outline: none;
    margin-left: 5px;
    background: white;
}
</style>
