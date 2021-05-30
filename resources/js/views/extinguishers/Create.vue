<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5>سحب طفاية من مبنى</h5>
                        <router-link exact :to="{ name: 'extinguishers' }" class="ml-auto btn btn-danger btn-sm">
                            إلغاء
                        </router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit_form">
                            <div class="form-group">
                                <label for="type">نوع الطفاية</label>
                                <select  v-model="extinguisher_id" id="type" class="form-control">
                                    <option value=""> --- </option>
                                    <option v-for="extinguisher in extinguishersType" :value="extinguisher.id">
                                        {{ extinguisher.type }}
                                    </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="building_id">تابعة لمبنى</label>
                                <select v-model="building_id" id="building_id" class="form-control">
                                    <option value=""> --- </option>
                                    <option v-for="building in buildings" :value="building.id">
                                        {{ building.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-dark">سحب</button>
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
            buildings: [],
            extinguisher_id: '',
            building_id: '',
        }
    },
    mounted() {
        this.extinguisherType();
        this.buildingName();
    },
    methods: {
        extinguisherType() {
            axios.get('/api/v1/extinguishers/type').then(response => {
                this.extinguishersType = response.data.extinguishersType
            })
        },
        buildingName() {
            axios.get('/api/v1/buildings/list').then(response => {
                this.buildings = response.data.buildings
            })
        },
        submit_form() {
            axios.post('/api/v1/extinguishers', {
                building_id: this.building_id,
                extinguisher_id: this.extinguisher_id
            }).then(response => {
                toast.fire({
                    icon: 'success',
                    title: 'تم السحب بنجاح'
                })
                this.$router.push('/extinguishers');
            })
        }
    }
}
</script>

<style scoped>

</style>
