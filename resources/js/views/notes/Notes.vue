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
            <tr v-for="building in buildings" :key="building.id">
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
import {computed, ref} from "vue";
import {useStore} from "vuex";

export default {
    beforeRouteEnter(to, from, next) {
        if (!localStorage.getItem("authToken")) {
            return next({name: 'login'})
        }
        next();
    },
    components: {
        Pagination
    },
    setup() {
        const store = useStore()
        const buildings = computed(() => store.state.building.buildings);
        const loading = computed(() => store.state.building.loading);
        const records = computed(() => store.state.building.records);
        const per_page = computed(() => store.state.building.per_page);
        const page = ref(store.state.building.page)
        store.dispatch('building/getAllBuildings', {page: page})

        function handlePageUpdate([p, per_p]) {
            page.value = p
            per_page.value = per_p
            store.dispatch('building/getAllBuildings', { page: page.value })
        }

        return {
            buildings,
            records,
            per_page,
            page,
            loading,
            handlePageUpdate
        }
    }
}
</script>

<style scoped></style>
