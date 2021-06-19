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
            <!--        <pagination v-model="page" :records="records" :per-page="per_page" @paginate="loadBuildings" />-->
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
import Pagination from "../../components/Pagination";
import {useStore} from 'vuex'
import {ref, reactive, computed, watch, toRefs, watchEffect} from "vue";

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
        const store = useStore()
        const search = ref("");
        const state = reactive({
            search: "",
            page: store.state.building.page,
            now: new Date().toISOString(),
            isSupervisor: computed(() => store.state.currentUser.isSupervisor),
            buildings: computed(() => store.state.building.buildings),
            records: computed(() => store.state.building.records),
            per_page: computed(() => store.state.building.per_page),
            loading: computed(() => store.state.building.loading),
        });
        const handlePageUpdate = ([page]) => {
            state.page = page;
            store.dispatch('building/getAllBuildings', {page: state.page, search: search.value});
        };

        let stopWatch = watch(search, (val, old) => {
            if (val.length >= 2 || old.length >= 2) {
                console.log("watch searching ", search.value)
                // this.$store.dispatch('building/getAllBuildings', { page: state.page, search: search.value })
            }
            if (val.length === 50) {
                stopWatch();
            }
        });

        return {
            ...toRefs(state),
            search,
            handlePageUpdate,
        }
    },
}
</script>

<style scoped>
a {
    text-decoration: none;
}
</style>
