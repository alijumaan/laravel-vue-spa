<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5>{{ $t('titles.pull_extinguisher_from_building') }}</h5>
                        <router-link exact :to="{ name: 'extinguishers' }" class="ml-auto btn btn-danger btn-sm">
                            {{ $t('actions.cancel') }}
                        </router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <label for="type">{{ $t('fields.type') }}</label>
                                <select  v-model="extinguisher_id" id="type" class="form-control">
                                    <option value=""> --- </option>
                                    <option v-for="(extinguisher, index) in extinguishersType" :value="extinguisher.id">
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
                                    <option value=""> --- </option>
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
                                <button type="submit" name="submit" class="btn btn-dark">{{ $t('buttons.execute') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref, toRefs} from "vue";
import useBuildings from "../../modules/buildings";
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n/index";

export default {
    setup() {
        const router = useRouter()
        const i18n = useI18n();
        const fields = reactive({
            extinguishersType: [],
            extinguisher_id: '',
            building_id: '',
        })
        const errors = ref([])

        const {buildings, loadBuildings} = useBuildings()

        loadBuildings();
        extinguisherType()

        function extinguisherType() {
            axios.get('/api/v1/extinguishers/type').then(response => {
                fields.extinguishersType = response.data.extinguishersType
            })
        }

        function submitForm() {
            axios.post('/api/v1/extinguishers', {
                building_id: fields.building_id,
                extinguisher_id: fields.extinguisher_id
            }).then( () => {
                toast.fire({
                    icon: 'success',
                    title: i18n.t('messages.executed_successfully')
                })
                router.push('/extinguishers');
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            })
        }

        return {
            ...toRefs(fields),
            buildings,
            errors,
            submitForm
        }
    }
}
</script>

<style scoped>

</style>
