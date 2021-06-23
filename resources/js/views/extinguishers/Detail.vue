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
                                    @click="remove_extinguisher(extinguisher.id, building.id)"
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
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useI18n} from "vue-i18n/index";
import {useRoute} from "vue-router";

export default {
    setup() {
        const i18n = useI18n();
        const route = useRoute()
        const store = useStore()
        const isAdmin = computed(() => {
            return store.state.currentUser.isAdmin
        })

        const extinguisher = ref("")
        const buildings = ref([])

        function getBuildingHasExtinguisher() {
            axios.get(`/api/v1/extinguishers/${route.params.id}`).then(response => {
                extinguisher.value = response.data.extinguisher
                buildings.value = response.data.buildings
            });
        }

        function remove_extinguisher(extinguisher, building) {
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
                    axios.delete(`/api/v1/extinguishers/${extinguisher}/${building}`).then(response => {
                        getBuildingHasExtinguisher();
                    })
                    toast.fire({
                        icon: 'success',
                        title: i18n.t('messages.deleted_successfully')
                    })
                }
            })
        }

        getBuildingHasExtinguisher();

        return {
            isAdmin,
            buildings,
            extinguisher,
            remove_extinguisher
        }
    }
}
</script>

<style scoped>

</style>
