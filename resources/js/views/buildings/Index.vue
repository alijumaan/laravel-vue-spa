<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="p-2 d-flex">
                        <input type="text" class="form-control w-50" v-model="search"
                               :placeholder="$t('fields.search')">

                        <router-link v-if="isSupervisor" :to="{ name: 'buildings.create'}"
                                     class="ml-auto btn btn-primary btn-sm">
                            <i class="fa fa-plus fa-fw"></i>
                            {{ $t('buttons.create_new_building') }}
                        </router-link>
                    </div>
                    <div :class="{'loading': loading}">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead class="">
                                <tr>
                                    <th colspan="1">
                                        <div class="input-group">

                                        </div>
                                    </th>
                                </tr>
                                <tr class="bg-dark text-white">
                                    <th>{{ $t('fields.building') }}</th>
                                    <th>{{ $t('fields.expiry_date') }}</th>
                                    <th>{{ $t('fields.status') }}</th>

                                </tr>
                                </thead>
                                <tbody v-if="buildings.length > 0">
                                <tr v-for="(building, index) in buildings" :key="index">
                                    <td>
                                    <span class="text-dark">
                                        <router-link :to="{ name: 'buildings.show', params: { id: building.slug } }">
                                            <span class="text-dark">{{ building.number }} /</span>
                                            {{ building.name }}
                                        </router-link>
                                    </span>
                                    </td>
                                    <td>
                                    <span :class="building.checked_at > now ? 'text-success' : 'text-danger'">
                                        {{ building.checked_at }}
                                    </span>
                                        <br>
                                        <span class="text-info">
                                        {{ building.checked_at_string }}
                                    </span>
                                    </td>
                                    <td>
                                    <span
                                        :class="building.status === 'Valid' ? 'badge badge-success' : 'badge badge-danger'">
                                        {{ building.status }}
                                    </span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <p class="text-center" v-show="!buildings.length > 0">{{ $t('messages.no_results') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3" v-show="buildings.length">
            <Pagination
                :page="page"
                :viewingAmount="per_page"
                :total="records"
                @change="handlePageUpdate"
            />
        </div>
    </div>
</template>

<script>
import {useStore} from 'vuex'
import {computed, ref, watch} from "vue";
import Pagination from "../../components/Pagination";

export default {
    components: {
        Pagination
    },
    beforeRouteEnter(to, from, next) {
        if (!localStorage.getItem("authToken")) {
            return next({name: 'login'})
        }
        next();
    },
    setup() {
        const store = useStore();
        const now = new Date().toISOString();
        const isSupervisor = computed(() => store.state.currentUser.isSupervisor);
        const buildings = computed(() => store.state.building.buildings);
        const loading = computed(() => store.state.building.loading);
        const records = computed(() => store.state.building.records);
        const per_page = computed(() => store.state.building.per_page);
        const page = ref(store.state.building.page)
        const search = ref("")

        if (store.state.loaded_buildings === true) {
            store.dispatch('building/getAllBuildings', { page: page.value })
            store.state.loaded_buildings = false
        }

        const stopWatch = watch(search, (val, old) => {
            if (val.length >= 2 || old.length >= 2) {
                store.dispatch('building/getAllBuildings', { page: page.value })
            }
            if (val.length === 50) {
                stopWatch();
            }
        });

        function handlePageUpdate([p, per_p]) {
            page.value = p
            per_page.value = per_p
            store.dispatch('building/getAllBuildings', { page: page.value })
        }

        return {
            search,
            buildings,
            records,
            per_page,
            page,
            isSupervisor,
            loading,
            now,
            handlePageUpdate
        }
    },
}
</script>

<style scoped>
a {
    text-decoration: none;
}
</style>



