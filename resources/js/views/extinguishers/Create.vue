<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="d-flex mb-3">
                    <router-link exact :to="{ name: 'extinguishers' }" class="ml-auto btn btn-danger btn-sm">
                        {{ $t('actions.cancel') }}
                    </router-link>
                </div>
                <div class="card">
                    <div class="card-header d-flex">
                        <h5>{{ $t('titles.pull_extinguisher_from_building') }}</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <label for="type">{{ $t('fields.type') }}</label>
                                <select v-model="extinguisher_id" id="type" class="form-control">
                                    <option value=""> ---</option>
                                    <option v-for="extinguisher in extinguishersType" :value="extinguisher.id">
                                        {{ extinguisher.type }}
                                    </option>

                                </select>
                                <div v-if="errors && errors.extinguisher_id">
                                    <div v-for="error in errors.extinguisher_id"
                                         class="text-danger" role="alert">
                                        <p>{{ error }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="building_id">{{ $t('fields.belong_to') }}</label>
                                <select v-model="building_id" id="building_id" class="form-control">
                                    <option value=""> ---</option>
                                    <option v-for="building in buildings" :value="building.id">
                                        {{ building.name }}
                                    </option>
                                </select>
                                <div v-if="errors && errors.building_id">
                                    <div v-for="error in errors.building_id"
                                         class="text-danger" role="alert">
                                        <p>{{ error }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-dark">{{ $t('buttons.execute') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {computed, reactive, ref, toRefs} from "vue";
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";
import {useStore} from "vuex";

export default {
    setup() {
        const router = useRouter()
        const store = useStore()
        const i18n = useI18n();
        const fields = reactive({
            extinguisher_id: '',
            building_id: '',
        })
        const errors = ref([])

        const buildings = computed(() => {
            return store.state.building.buildings
        })
        if (store.state.loaded_buildings === true) {
            store.dispatch('building/getAllBuildings', { page: 1 })
            store.state.loaded_buildings = false
        }


        const extinguishersType = ref([])
        function getExtinguisherType() {
            axios.get('/api/v1/extinguishers/type').then(response => {
                extinguishersType.value = response.data.extinguishersType
            })
        }

        getExtinguisherType()

        function submitForm() {
            axios.post('/api/v1/extinguishers', {
                building_id: fields.building_id,
                extinguisher_id: fields.extinguisher_id
            }).then(() => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.executed_successfully')
                })
                store.dispatch('extinguisher/getExtinguishers')
                router.push({name: 'extinguishers'});
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            })
        }

        return {
            ...toRefs(fields),
            buildings,
            extinguishersType,
            errors,
            submitForm
        }
    }
}
</script>

<style scoped>

</style>
