<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex mb-3">
                <router-link exact :to="{ name: 'extinguishers' }" class="ml-auto btn btn-primary btn-sm">
                    {{ $t('actions.back') }}
                </router-link>
            </div>
            <div class="card shadow">
                <div class="p-3 d-flex">
                    <h4>{{ $t('titles.details') }} ( {{ extinguisher.extinguisherType }} )</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="">
                        <tr class="bg-dark text-white">
                            <th>{{ $t('fields.type') }}</th>
                            <th>{{ $t('fields.count') }}</th>
                            <th>{{ $t('fields.building') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>{{ extinguisher.extinguisherType }}</td>
                            <td>{{ extinguisher.extinguisherCount }}</td>
                            <td style="display: block"
                                v-if="buildings.length > 0"
                                v-for="building in buildings">
                                {{ building.name }}
                                <button
                                    v-if="isAdmin"
                                    @click="restore_extinguisher(extinguisher.id, building.id)"
                                    class="btn btn-link">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </td>
                            <td v-if="!buildings.length > 0">
                                لايوجد نتائج
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            extinguisher: '',
            buildings: [],
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        }
    },
    created() {
        this.$store.dispatch('currentUser/isAdmin');
        this.getBuilding();
    },
    methods: {
        getBuilding() {
            axios.get(`/api/v1/extinguishers/${this.$route.params.id}`).then(response => {
                this.extinguisher = response.data.extinguisher
                this.buildings = response.data.buildings
            });
        },
        restore_extinguisher(extinguisher, building) {
            swal.fire({
                title: this.$i18n.t('messages.are_you_sour?'),
                text: this.$i18n.t('messages.You_wont_be_able_to_undo_this'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: this.$i18n.t('messages.delete_confirmation')
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/v1/extinguishers/${extinguisher}/${building}`).then(response => {
                        console.log(response)
                        this.getBuilding();
                    })
                    toast.fire({
                        icon: 'success',
                        title: this.$i18n.t('messages.deleted_successfully')
                    })
                }
            })
        },
    }
}
</script>

<style scoped>

</style>
