<template>
    <div>
        <table class="table table-striped table-light">
            <thead class="table-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">المبنى</th>
                <th scope="col">الملاحظة</th>
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
    data() {
        return {
            buildings: {}
        }
    },
    created() {
        this.loadNotes()
    },
    methods: {
        loadNotes() {
            axios.get("/api/v1/buildings/list").then(response => {
                this.buildings = response.data.buildings
            })
        }
    }
}
</script>

<style scoped></style>
