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
            <div>
                <Pagination
                    :page="page"
                    :viewingAmount="per_page"
                    :total="records"
                    @change="handlePageUpdate"
                />
            </div>
        </div>
    </div>
</template>

<script>
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
    data() {
        return {
            // buildings: {},
            // page: 1,
            // records: 0,
            // per_page: 0,
            // loading: true,
            page: this.$store.state.building.page,
            now: new Date().toISOString(),
            search: "",
        }
    },
    watch: {
        search(val, old) {
            if (val.length >= 2 || old.length >= 2) {
                this.loadBuildings();
            }
        }
    },
    computed: {
        isSupervisor() {
            return this.$store.state.currentUser.isSupervisor;
        },
        buildings() {
            return this.$store.state.building.buildings;
        },
        loading() {
            return this.$store.state.building.loading;
        },
        per_page() {
            return this.$store.state.building.per_page;
        },
        records() {
            return this.$store.state.building.records;
        },
    },
    // mounted() {
    //     this.loadBuildings();
    // },
    methods: {
        handlePageUpdate([page, per_page]) {
            this.page = page;
            this.per_page = per_page;
            this.$store.dispatch('building/getAllBuildings', {page: this.page});
        },

        loadBuildings(page = this.page) {
            axios.get('/api/v1/buildings?page=' + page, {
                params: {
                    search: this.search.length >= 2 ? this.search : ""
                }
            }).then(response => {
                this.records = response.data.buildings_count
                 this.per_page = response.data.pagination
                 this.buildings = response.data.buildings.map(data => ({
                     slug: data.slug,
                     name: data.name,
                     number: data.number,
                     checked_at: data.checked_at,
                     checked_at_string: data.checked_at_string,
                     status: data.statusText
                 }))
                 this.loading = false;
             })
         },
    }
}
</script>

<style scoped>
a {
    text-decoration: none;
}
</style>
