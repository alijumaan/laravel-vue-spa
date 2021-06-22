<template>
    <div :class="{'loading': loading}">
        <table class="table table-striped table-light">
            <thead class="table-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">{{ $t('fields.building') }}</th>
                <th scope="col">{{ $t('fields.note') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(building, index) in buildings">
                <th scope="row">{{ building.id }}</th>
                <td>{{ building.name }}</td>
                <td class="text-danger">{{ building.notes }}</td>
            </tr>
            </tbody>
        </table>
        <Pagination
            :page="page"
            :viewingAmount="per_page"
            :total="records"
            @change="handlePageUpdate"
        />
    </div>
</template>

<script>
import Pagination from "../../components/Pagination";

export default {
    beforeRouteEnter(to, from, next) {
        if (!localStorage.getItem("authToken")) {
            return next({name: 'login'})
        }
        next();
    },
    data() {
      return {
          page: this.$store.state.building.page,
      }
    },
    components: {
        Pagination
    },
    computed: {
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
    methods: {
        handlePageUpdate([page, per_page]) {
            this.page = page;
            this.per_page = per_page;
            this.$store.dispatch('building/getAllBuildings');
        },
    }
}
</script>

<style scoped></style>
