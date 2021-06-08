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
                        <form @submit.prevent="submit_form">
                            <div class="form-group">
                                <label for="type">{{ $t('fields.type') }}</label>
                                <select  v-model="extinguisher_id" id="type" class="form-control">
                                    <option value=""> --- </option>
                                    <option v-for="(extinguisher, index) in extinguishersType" :value="extinguisher.id">
                                        {{ extinguisher.type }}
                                    </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="building_id">{{ $t('fields.belong_to') }}</label>
                                <select v-model="building_id" id="building_id" class="form-control">
                                    <option value=""> --- </option>
                                    <option v-for="building in buildings" :value="building.id">
                                        {{ building.name }}
                                    </option>
                                </select>
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
export default {
    data() {
        return {
            extinguishersType: [],
            extinguisher_id: '',
            building_id: '',
        }
    },
    computed: {
        buildings() {
            return this.$store.state.building.buildings;
        }
    },
    created() {
        this.extinguisherType();
        this.$store.dispatch('building/getBuilding');
    },
    methods: {
        extinguisherType() {
            axios.get('/api/v1/extinguishers/type').then(response => {
                this.extinguishersType = response.data.extinguishersType
            })
        },
        submit_form() {
            axios.post('/api/v1/extinguishers', {
                building_id: this.building_id,
                extinguisher_id: this.extinguisher_id
            }).then( () => {
                toast.fire({
                    icon: 'success',
                    title: this.$i18n.t('messages.executed_successfully')
                })
                this.$router.push('/extinguishers');
            })
        }
    }
}
</script>

<style scoped>

</style>
