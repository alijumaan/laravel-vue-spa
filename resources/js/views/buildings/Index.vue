<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="p-2 d-flex">
                        <input type="text" class="form-control w-50" v-model="search"
                               placeholder="بحث">

                        <router-link v-if="isSupervisor" :to="{ name: 'buildings.create'}"
                                     class="ml-auto btn btn-primary btn-sm">
                            <i class="fa fa-plus fa-fw"></i>
                            {{ $t('buttons.create_building') }}
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
                                    <th>المبنى</th>
                                    <th>الانتهاء</th>
                                    <th>الحالة</th>
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
                                        :class="building.status === 'مشيك' ? 'badge badge-success' : 'badge badge-danger'">
                                        {{ building.status }}
                                    </span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <p class="text-center" v-show="!buildings.length > 0">لاتوجد نتائج.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-show="buildings.length">
            <div class="col-12 mt-3">
                <pagination v-model="page" :records="records" :per-page="per_page" @paginate="loadBuildings" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    beforeRouteEnter(to, from, next) {
        if (!localStorage.getItem("authToken")) {
            return next({name: 'login'})
        }
        next();
    },
    data() {
        return {
            buildings: {},
            now: new Date().toISOString(),
            search: "",
            page: 1,
            records: 0,
            per_page: 0,
            loading: true,
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
        }
    },
    created() {
        this.loadBuildings()
        this.$store.dispatch('currentUser/isSupervisor');
    },
    methods: {
        loadBuildings(page = this.page) {
            axios.get('/api/v1/buildings?page=' + page, {
                params: {
                    search: this.search.length >= 2 ? this.search : ""
                }
            }).then(response => {
                this.records = response.data.buildings_count
                this.per_page = response.data.paginate
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
