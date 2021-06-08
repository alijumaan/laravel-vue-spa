<template>
    <div>
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
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ building.name }}</td>
                <td class="text-danger">{{ building.notes }}</td>
            </tr>
            </tbody>
        </table>

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
    computed: {
        buildings() {
            return this.$store.state.building.buildings;
        },
    },
    created() {
        this.load_buildings()
    },
    methods: {
        load_buildings() {
            this.$store.dispatch('building/getBuilding');
        }
    }
}
</script>

<style scoped></style>
