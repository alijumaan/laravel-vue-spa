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
            <tr v-for="(building, index) in buildings" :key="building.id">
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
import {ref} from "vue";

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
        const {
            page,
            buildings,
            loadBuildings,
            loading,
            per_page,
            records,
            handlePageUpdate
        } = useBuildings()

        const pages = ref([])
        const loadPage = () => {
            axios.get("/api/v1/pages").then(response => {
                pages.value = response.data.pages
            });
        }

        loadBuildings()
        loadPage()

        return {
            page,
            buildings,
            loading,
            per_page,
            records,
            handlePageUpdate
        }
    }
}
</script>

<style scoped></style>
